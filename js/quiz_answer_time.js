let refinfo = document.referrer;
if (!refinfo) {
    alert('直リンクはご遠慮下さいませ(;・∀・)');
}

Vue.component('countdown', {
    data: function() {
        return {
            timeLimit: timeLimit,
            message: '',
            nowDateTime: '',
            startDateTime: '',
            finishDateTime: '',
        }
    },
    mounted: function() {
        this.nowDateTime = new Date();
        this.startDateTime = this.nowDateTime;
        this.finishDateTime = this.nowDateTime;
        this.finishDateTime.setSeconds(this.finishDateTime.getSeconds() + Number(this.timeLimit));

        this.countDown();
        setInterval(this.countDown, 1000);
    },
    methods: {
        countDown: function() {
            let diffDateTime = 0;
            if (this.timeLimit > 0) {
                this.nowDateTime = new Date();

                diffDateTime = Math.floor((this.finishDateTime.getTime() - this.nowDateTime.getTime()) / 1000);
                if (diffDateTime < 0) {
                    diffDateTime = 0;
                }
                this.timeLimit = diffDateTime;

                this.message = `残り ${this.timeLimit} 秒`;
            } else {
                this.timeLimit = 0;
                this.message = '少々お待ちください・・・';

                let radioButton = document.getElementsByClassName('js_your_answer');
                let radioButtonLength = radioButton.length;

                for (let i = 0; i < radioButtonLength; i++) {
                    radioButton[i].setAttribute('disabled', true);
                }

                let superSatoshikunButton = document.getElementsByClassName('js_super_satoshikun');
                let suberSatoshikunButtonLength = superSatoshikunButton.length;

                for (let i = 0; i < suberSatoshikunButtonLength; i++) {
                    superSatoshikunButton[i].setAttribute('disabled', true);
                }

                setTimeout(submitPage, 3000);
            }
        }
    },
    template: '<div v-text="message" class="text-center font-bold text-lg" id="js_countdown"></div>'
});

var app = new Vue({
    el: '#app_countdown',
});

function submitPage() {
    document.quizTimeup.submit();
}

function updateAnswerDataOnAjax(data) {
    let xhr = new XMLHttpRequest();

    xhr.open('POST', './Ajax.php');
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xhr.send(encodeHtmlForm(data));
}

let answerData = {
    'fnc_name' : 'changeMemberAnswer',
    'member_id' : memberId,
    'game_id' : gameId,
    'game_order' : gameOrder,
    'your_answer' : '',
};

function resisterYourAnswer(val) {
    answerData.your_answer = val;
    updateAnswerDataOnAjax(answerData);
}

let supersatoshiData = {
    'fnc_name' : 'changeIsUsingSupersatoshikun',
    'member_id' : memberId,
    'game_id' : gameId,
    'game_order' : gameOrder,
    'is_using_super_satoshikun' : '',
}

function changeIsUsingSupersatoshikun(val) {
    if (superSatoshikunStock <= 0) {
        return;
    }

    supersatoshiData.is_using_super_satoshikun = val;
    updateAnswerDataOnAjax(supersatoshiData);
}