<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use LANMS\News;
use LANMS\NewsCategory;

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-1',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-2',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-3',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-4',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-5',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-6',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-7',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-8',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-9',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-10',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-11',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-12',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-13',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-14',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-15',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));
        News::create(array(
            'title'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'slug'          => 'news-16',
            'content'       => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mauris sapien, volutpat eget pretium nec, commodo vel nisi. Integer ac metus posuere, volutpat quam id, volutpat leo. In ut euismod ipsum. Fusce euismod justo vitae porta pellentesque. Cras fringilla erat ornare dui suscipit, et pharetra elit egestas. Integer id lacus vel nulla varius viverra. Pellentesque non accumsan sapien, ac hendrerit nisi. Praesent cursus ac orci imperdiet tincidunt. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p><p>Nulla vel augue ac dui ullamcorper rutrum. Duis vel leo ornare, bibendum massa a, pharetra felis. Curabitur in turpis neque. Nam gravida aliquet velit quis tempor. Mauris accumsan lorem lorem, eget viverra dui dignissim ac. Sed nulla lacus, pharetra ut finibus ac, convallis ut massa. Pellentesque malesuada risus vitae sagittis congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce porta libero libero, vel imperdiet magna blandit eget. Proin auctor consequat risus ac ullamcorper.</p><p>Quisque magna sapien, suscipit vel enim ac, hendrerit bibendum sem. Vivamus ut dolor pretium, venenatis augue in, malesuada sem. Fusce eu ipsum ut neque mattis suscipit. Donec ultrices ipsum et sapien ultrices, vel rutrum enim placerat. Vivamus luctus sodales neque, eu molestie nulla eleifend maximus. Nulla non lobortis enim. Donec eu vestibulum erat. Ut quis faucibus risus. Aliquam commodo in nisl at dictum. Duis mattis nisl eget enim ultrices varius. Etiam nulla mi, finibus eget tempus varius, vehicula at neque. Sed eleifend felis sed turpis laoreet, sed lacinia sem pharetra.</p>',
            'editor_id'     => 1,
            'author_id'     => 1,
            'category_id'   => 1,
            'published_at'  => Carbon::now(),
        ));

        NewsCategory::create([
            'name'      => 'Uncategorized',
            'slug'      => 'uncategorized',
        ]);
        NewsCategory::create([
            'name'      => 'Test',
            'slug'      => 'test',
        ]);
        NewsCategory::create([
            'name'      => 'Derp',
            'slug'      => 'derp',
        ]);
    }
}