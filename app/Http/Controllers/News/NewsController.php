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
            return view('news.index')->withNews($news);
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

            $published_at_date = $request->get('published_at_date');
            $published_at_time = $request->get('published_at_time');
            $published_at = date('Y-m-d H:i:s', strtotime("$published_at_date $published_at_time"));

            $title = $request->get('title');
            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
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

            $link = route('news-show', $slug);

            if ($articlesave) {
                if ($request->get('socialmedia') == "on") {
                    if (env('TWITTER_CONSUMER_KEY') != '' && env('TWITTER_CONSUMER_SECRET') != '' && env('TWITTER_ACCESS_TOKEN') != '' && env('TWITTER_ACCESS_TOKEN_SECRET') != '') {
                        \Toolkito\Larasap\SendTo::Twitter($title.' - '.$link);
                    }
                    if (env('FACEBOOK_APP_ID') != '' && env('FACEBOOK_APP_SECRET') != '' && env('FACEBOOK_PAGE_ACCESS_TOKEN') != '') {
                        \Toolkito\Larasap\SendTo::Facebook(
                            'link',
                            [
                                'link' => $link,
                                'message' => $title
                            ]
                        );
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
        abort_unless($article, 404);

        return view('news.article')->withArticle($article);
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

            $published_at_date = $request->get('published_at_date');
            $published_at_time = $request->get('published_at_time');
            $published_at = date('Y-m-d H:i:s', strtotime("$published_at_date $published_at_time"));

            $slug = $request->get('slug');
            if (!is_null($slug)) {
                $slug = str_slug($slug, '-');
            } else {
                $slug = str_slug($request->get('title'), '-');
            }

            $article                = News::find($id);
            $article->title         = $request->get('title');
            $article->content       = $request->get('content');
            $article->active        = $active;
            $article->slug          = $slug;
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
