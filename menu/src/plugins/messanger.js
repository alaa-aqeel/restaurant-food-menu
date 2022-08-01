

export function initFBAsync() {

    window.fbAsyncInit = function() {
        window.FB.init({
            cookie: true,
            xfbml:true,
            version: 'v14.0'
        });
    };

}

export function setPageId(pageId) {
    var chatbox = window.document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", pageId);
    chatbox.setAttribute("attribution", "setup_tool");
}

export function setMessangerSDK(doc, src, id){

    var js, fbjs = doc.getElementsByTagName(src)[0];
    if (doc.getElementById(id)) return;
    js = doc.createElement(src); js.id = id;
    js.src = 'https://connect.facebook.net/ar_AR/sdk/xfbml.customerchat.js';
    fbjs.parentNode.insertBefore(js, fbjs);
}


export function messangerInit(pageId) {
    setPageId(pageId);
    initFBAsync();
    setMessangerSDK(window.document, 'script', 'facebook-jssdk');
}