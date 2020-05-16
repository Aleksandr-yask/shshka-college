if ( document.querySelector('.content-header-title > h1').innerHTML.replace(/\s/g, '') == 'Заказы') {
    const el = document.createElement('div');
    el.className = 'button-action';
    el.innerHTML = `
                <a class="btn btn-success" href="/export" target="_blank">
                                        Скачать
                </a>
            `
    document.querySelector('.global-actions').appendChild(el);
}