


export function setTitle(title) {
    document.getElementsByTagName('title')
                    .item(0).innerText = title
}

// robots = noindex,nofollow
// description
// Keyword
// image
// author
/* <meta property="og:type" content="article" />
<meta property="og:title" content="TITLE OF YOUR POST OR PAGE" />
<meta property="og:description" content="DESCRIPTION OF PAGE CONTENT" />
<meta property="og:image" content="LINK TO THE IMAGE FILE" />
<meta property="og:url" content="PERMALINK" />
<meta property="og:site_name" content="SITE NAME" /> */

export function addMeta(name, content, property='') {

    var meta = document.createElement('meta');
    meta.name = name;
    meta.content = content;
    meta.property = property;
    document.getElementsByTagName('head')
                    .item(0).appendChild(meta);
}


export function initSEO(menu) {

    setTitle(menu.title);
    addMeta('description', menu.description);
    addMeta('title', menu.title);
    addMeta('keywords', 'menu,منيو, أكل, مشاوي,food'+menu.title.split(' ').join(','));
    addMeta('image', import.meta.env.VITE_API_DOWEN+menu.image);
    addMeta('url', import.meta.env.VITE_DOWEN+"/"+menu.slug);

    addMeta('og:description', menu.description);
    addMeta('og:title', menu.title);
    addMeta('og:keywords', 'menu,منيو, أكل, مشاوي,food'+menu.title.split(' ').join(','));
    addMeta('og:image', import.meta.env.VITE_API_DOWEN+menu.image);
    addMeta('og:url', import.meta.env.VITE_DOWEN+"/"+menu.slug);
    addMeta('og:site_name', menu.title);
}