<?php
class SessionsController extends BaseController 
{
    protected $layout = 'layouts.default';

    public function create()
    {
        $this->layout->content = View::make('sessions.create');
    }

    public function store()
    {
    
    }

    public function destroy()
    {
        Auth::logOut();
        return Redirect::home();
    }
}
