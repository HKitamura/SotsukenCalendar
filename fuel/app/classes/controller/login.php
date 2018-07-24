<?php
class Controller_Login extends Controller
{
    public function action_index()
    {
        //すでにログイン済であればログイン後のページへリダイレクト
        Auth::check() and Response::redirect('calendar6');
        //エラーメッセージ用変数初期化
        $error = null;
        //ログイン用のオブジェクト生成
        $auth = Auth::instance();
        //ログインボタンが押されたら、ユーザ名、パスワードをチェックする
        if (Input::post()) {
            if ($auth->login(Input::post('username'), Input::post('password'))) {
                // ログイン成功時、ログイン後のページへリダイレクト
                Response::redirect('/calendar6');
            }
			else{
                // ログイン失敗時、エラーメッセージ作成
                $error = 'ユーザ名かパスワードに誤りがあります';
            }
        }
        //ビューテンプレートを呼び出し
        $view = View::forge('login/index');
        //エラーメッセージをビューにセット
        $view->set('error', $error);
        return $view;
    }
}