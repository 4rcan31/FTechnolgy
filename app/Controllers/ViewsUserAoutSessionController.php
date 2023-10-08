<?php


class ViewsUserAoutSessionController extends BaseController{

    /**
    * @return AppsModel
    */
    public function apps(){
        return model('AppsModel');
    }

        /**
    * @return FAQModel
    */
    public function faq(){
        return model('FAQModel');
    }

    public function seeStore(){
        view('store', $this->apps()->get());
    }


    public function seeProduct($id){
        if(!is_numeric($id)){
            Server::redirect('/store');
        }
        $this->apps()->existById($id) ? 
        view('see', $this->apps()->getAppsByIdApp($id)) :
        Server::redirect('/store');
    }


    public function seeFaq(){
        view('/faq', $this->faq()->get());
    }
}