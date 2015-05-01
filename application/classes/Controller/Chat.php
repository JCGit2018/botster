<?php

class Controller_Chat extends Controller_Base
{
	public function action_index()
	{
        $this->template->title = 'Botster - Chatbot Artificial Intelligence';
        $this->page->set_filename('chat');
	}
}
