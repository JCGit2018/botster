<div class="app">
    <div class="container">
        <div class="statistics">
            <div title="People chatting" class="statistic">
                <img src="<?=URL::site('images/icons/user.png')?>" alt="People chatting: " class="icon" />
                <div id="online" class="number"></div>
            </div>
            <div title="Conversations had" class="statistic">
                <img src="<?=URL::site('images/icons/speech_bubbles.png')?>" alt="" class="icon" />
                <div id="conversations" class="number"></div>
            </div>
            <div title="Unique utterances" class="statistic">
                <img src="<?=URL::site('images/icons/quote.png')?>" alt="" class="icon" />
                <div id="utterances" class="number"></div>
            </div>
            <div title="Utterance connections" class="statistic">
                <img src="<?=URL::site('images/icons/link.png')?>" alt="" class="icon" />
                <div id="connections" class="number"></div>
            </div>
        </div>
        <div class="chat">
            <div id="messages" class="messages"></div>
            <div class="input">
                <input type="text" maxlength="100" autocomplete="off" x-webkit-speech placeholder="Type a message..." id="input" class="text-box" />
            </div>
        </div>
    </div>
</div>
