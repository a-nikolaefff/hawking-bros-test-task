<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Tag;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class ParseNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse news from RSS feed';

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        $response = Http::get('https://lenta.ru/rss/news');
        $xml = new SimpleXMLElement($response->body());

        $newsAmount = 0;
        foreach ($xml->channel->item as $item) {
            $data['guid'] = (string)$item->guid;
            $isNewsAlreadyExist = News::where('guid', $data['guid'])->exists();

            if (!$isNewsAlreadyExist) {
                $data['title'] = (string)$item->title;
                $data['link'] = (string)$item->link;
                $data['description'] = (string)$item->description;
                $data['publication'] = Carbon::parse($item->pubDate);

                $imageUrl = (string)$item->enclosure['url'];
                $imageContent = file_get_contents($imageUrl);
                $imageName = basename($imageUrl);
                $data['image_path'] = 'images/' . $imageName;
                Storage::put('public/' . $data['image_path'], $imageContent);

                $news = News::create($data);

                $tagName = (string)$item->category;
                $tag = Tag::where('name', $tagName)->get()->first();
                if (!isset($tag)) {
                    $tag = Tag::create(['name' => $tagName]);
                }
                $news->tags()->attach($tag->id);

                $newsAmount++;
            }
        }

        $this->info("На сайт было добавлено $newsAmount новостей");
    }
}
