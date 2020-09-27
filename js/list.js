var jquery = require("jquery");
window.$ = window.jQuery = jquery;
require("jquery-ui-dist/jquery-ui.js");

$(".item-list").sortable({ connectWith: '.item-list' })
$(".item-list").disableSelection();


const readResults = () => {
    const lists = [...document.getElementsByClassName('item-list')]

    const items = []

    lists.forEach(list => {
        const draggables = list.getElementsByClassName('draggable')

        for (let i = 1; i <= draggables.length; i++) {
            items.push({
                id: draggables[i - 1].id,
                text: draggables[i - 1].innerHTML,
                list_id: list.id,
                position: i
            })
        }
    })

    return items
}

const save = async () => {
    const items = readResults()
    const body = JSON.stringify(items)


    $.ajax({
        url: '/list',
        method: 'post',
        dataType: 'json',
        data: { items: body },
        success: res => {
            if (res.errors && res.errors.length > 0) {
                res.errors.forEach(err => {
                    document.getElementsByClassName('error-message')[0].innerHTML += err + '<br>'
                })
                return
            }

            document.getElementsByClassName('error-message')[0].innerHTML = 'Lists Successfully saved'
        },
        fail: res => {
            document.getElementsByClassName('error-message')[0].innerHTML = 'Unexpected error'
        }
    })
}

$('#save_lists').on('click', () => {
    save()
})