<?php

namespace LANMS\Http\Controllers\News;

use LANMS\Http\Requests;
use LANMS\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Redirect;

use LANMS\News;
use LANMS\NewsCategory;
use LANMS\Page;

use anlutro\LaravelSettings\Facade as Setting;

use LANMS\Http\Requests\Admin\News\NewsCreateRequest;
use LANMS\Http\Requests\Admin\News\NewsEditRequest;

class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $news = News::isPublished()->paginate(5);
        return view('news.index')
                    ->withNews($news);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function admin()
    {
        if (Sentinel::getUser()->hasAccess(['admin.news.*'])) {
            $news = News::all();
            return view('news.index')
                        ->withNews($news);
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (Sentinel::getUser()->hasAccess(['admin.news.create'])) {
            $categories = NewsCategory::all();
            return view('news.create')->withCategories($categories);
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(NewsCreateRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.news.create'])) {
            $active = false;
            if ($request->get('active') == "on") {
                $active = true;
            }

            $published_at_date = date_format(date_create_from_format('D, d F Y', $request->get('published_at_date')), 'Y-m-d');
            ;
            $datetime = new \DateTime($published_at_date);
            $date = $datetime->format('Y-m-d');
            $published_at_time = $request->get('published_at_time');
            $published_at = date('Y-m-d H:i:s', strtotime("$published_at_date $published_at_time"));

            $title = $request->get('title');
            $slug = $request->get('slug');

            if ($slug == null) {
                $lettersNumbersSpacesHypens = preg_replace('/[^\-\s\pN\pL]+/u', '', strtolower($title));
                $spacesDuplicateHypens = preg_replace('/[\-\s]+/', '-', $lettersNumbersSpacesHypens);
                $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
                $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
                $normalize_slug = str_replace($a, $b, $spacesDuplicateHypens);
                $shorten_slug = substr($normalize_slug, 0, 50);
                $slug = trim($shorten_slug, '-');
            }

            $article                = new News;
            $article->title         = $title;
            $article->slug          = $slug;
            $article->content       = $request->get('content');
            $article->active        = $active;
            $article->published_at  = $published_at;
            $article->category_id   = $request->get('category_id');
            $article->author_id     = Sentinel::getUser()->id;
            $article->editor_id     = Sentinel::getUser()->id;

            $articlesave            = $article->save();

            $port = (Setting::get('WEB_PORT') <> 80) ? '' : ':'.Setting::get('WEB_PORT');
            $link = Setting::get('WEB_PROTOCOL').'://'.Setting::get('WEB_DOMAIN').'/'.$slug;

            if ($articlesave) {
                if ($request->get('socialmedia') == "on") {
                    if (env('TWITTER_CONSUMER_KEY') != '' && env('TWITTER_CONSUMER_SECRET') != '' && env('TWITTER_ACCESS_TOKEN') != '' && env('TWITTER_ACCESS_TOKEN_SECRET') != '') {
                        \Toolkito\Larasap\SendTo::Twitter($title.' - '.$link);
                    }
                }

                return Redirect::route('admin-news')
                        ->with('messagetype', 'success')
                        ->with('message', 'The article has now been saved and published!');
            } else {
                return Redirect::route('admin-news-create')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the article.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $article = News::where('slug', '=', $id)->first();
        $pagesinmenu = Page::where('active', '=', true)->where('showinmenu', '=', true)->get(); // This needs to be included in all the frontend pages

        return view('news.article')
                ->withArticle($article)
                ->with('pagesinmenu', $pagesinmenu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if (Sentinel::getUser()->hasAccess(['admin.news.update'])) {
            $article = News::find($id);
            $categories = NewsCategory::all();
            return view('news.edit')->withArticle($article)->withCategories($categories);
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, NewsEditRequest $request)
    {
        if (Sentinel::getUser()->hasAccess(['admin.news.update'])) {
            $active = false;
            if ($request->get('active') == "on") {
                $active = true;
            }

            $published_at_date = date_format(date_create_from_format('D, d F Y', $request->get('published_at_date')), 'Y-m-d');
            ;
            $datetime = new \DateTime($published_at_date);
            $date = $datetime->format('Y-m-d');
            $published_at_time = $request->get('published_at_time');
            $published_at = date('Y-m-d H:i:s', strtotime("$published_at_date $published_at_time"));

            $article                = News::find($id);
            $article->title         = $request->get('title');
            $article->content       = $request->get('content');
            $article->active        = $active;
            $article->published_at  = $published_at;
            $article->category_id   = $request->get('category_id');
            $article->editor_id     = Sentinel::getUser()->id;

            if ($article->save()) {
                return Redirect::route('admin-news-edit', $id)
                        ->with('messagetype', 'success')
                        ->with('message', 'The article has now been saved!');
            } else {
                return Redirect::route('admin-news-edit', $id)
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while saving the article.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Sentinel::getUser()->hasAccess(['admin.news.destroy'])) {
            $article = News::find($id);
            if ($article->delete()) {
                return Redirect::route('admin-news')
                        ->with('messagetype', 'success')
                        ->with('message', 'The article has now been deleted!');
            } else {
                return Redirect::route('admin-news')
                    ->with('messagetype', 'danger')
                    ->with('message', 'Something went wrong while deleting the article.');
            }
        } else {
            return Redirect::back()->with('messagetype', 'warning')
                                ->with('message', 'You do not have access to this page!');
        }
    }
}
