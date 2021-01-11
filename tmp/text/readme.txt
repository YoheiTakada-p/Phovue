ちょっとした事を写真とともにさくっと投稿してみよう

コメント機能を実装しない理由は、ページを写真一覧ページと登録ページだけの構成で考えているため。
まずはさくっとシンプルに動くアプリを作る！
写真一覧画面にコメントを表示させるとコメントがたくさんついた場合、写真カードが長くなるのは嫌だなぁと。
写真詳細ページとか新たなページを作成した時にコメント機能を追加するかも。

機能一覧

ログインする
ログアウトする
会員登録する
写真とタイトルとお気に入り数を一覧で表示する
写真を投稿する
写真にお気に入りを付ける
写真からお気に入りを外す
写真をダウンロードできる

テーブル
users（laravel既存のusersテーブルを使用）
photos
・id (bigint, primary)
・user_id (bigint, foreign->users(id))
・filename (var)
・created_at (timestamp)
・updeted_at (timestamp)
likes
・id (bigint, primary)
・photo_id (bigint, foreign->photos(id))
・user_id (bigint, foreign->users(id))
・created_at (timestamp)
・updeted_at (timestamp)

API

'/api/register' [POST] 会員登録
'/api/login' [GET] ログイン
'/api/logout' [POST, auth] ログアウト
'/api/photos' [GET] 写真一覧取得
'/api/photos' [POST, auth] 写真投稿
'/api/photos/{photos:id}/like' [POST, auth] 写真に紐づいたお気に入りを登録
'/api/photos/{photos:id}/like' [PUT, auth] 写真に紐づいたお気に入りを削除
'/api/user' [GET] 認証ユーザー取得

WEB
'/' [GET] index.blade.php
'/photos/{photos:id}/download' [GET]

vue-router 3.4.9
'/' 写真一覧ページ
'/register' 会員登録ページ

vuex 3.6.0
認証とエラーを管理