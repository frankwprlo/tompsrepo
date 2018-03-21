var isEventSupported = (function(){
        var TAGNAMES = {
                'select':'input','change':'input',
                'submit':'form','reset':'form',
                'error':'img','load':'img','abort':'img'
        }
        function isEventSupported(eventName) {
                var el = document.createElement(TAGNAMES[eventName] || 'div');
                eventName = 'on' + eventName;
                var isSupported = (eventName in el);
                if (!isSupported) {
                        el.setAttribute(eventName, 'return;');
                        isSupported = typeof el[eventName] == 'function';
                }
                el = null;
                return isSupported;
        }
        return isEventSupported;
})();

var _scOnInputSupport = isEventSupported('input');

function scLoadScInput(elemSelector) {
/*
        if (_scOnInputSupport) {
                $(elemSelector).scInput();
        }
        else {
                $(elemSelector).listen();
        }
*/        
                $(elemSelector).listen();
}