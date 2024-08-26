
if(document.querySelector('.news_item') != null){
    const news_items = document.querySelectorAll('.news_item');
    if(news_items.length >= 6){
        for (let i = 6; i < news_items.length; i++) {
            news_items[i].style.display = "none";
        }
    }
}
if(document.querySelector('.news_care_item') != null){
    const news_care_items = document.querySelectorAll('.news_care_item');
    if(news_care_items.length >= 6){
        for (let i = 6; i < news_care_items.length; i++) {
            news_care_items[i].style.display = "none";
        }
    }
}
const news_category_items = document.querySelectorAll('.news_category_item');
const category_items = document.querySelectorAll('.category_item');
let arr = []
for (let i = 0; i < category_items.length; i++) {
    let id_category = category_items[i].getAttribute('category');
    for (let e = 0; e < news_category_items.length; e++) {
        let id_item = news_category_items[e].getAttribute('category');
        
        if(id_item == id_category){
            // console.log(news_category_items[e])
            // console.log('end')
            arr.push(news_category_items[e])
        }
    }
    for (let result = 0; result < 3; result++) {
        if(arr[result] != null){
            arr[result].style.display = "block";
        }
    }
    arr = []
}
if(category_items.length > 5){
    for (let i = 5; i < category_items.length; i++) {
        category_items[i].style.display = "none";
    }
}

const title_limit_items = document.querySelectorAll('.title_limit');
title_limit_items.forEach((item)=>{
    if(item.textContent.length > 40){
        item.innerText = item.textContent.slice(0,40) + '...';
    }
})

// Message
if(document.querySelector('.message_box') !== null){
    const hide_message = document.querySelector('.hide_message');
    const message_box = document.querySelector('.message_box');
    hide_message.addEventListener('click',() => {
        message_box.style.display = "none";
    })
    if(message_box !== null){
        let time = setTimeout(()=>{
            message_box.style.display = "none";
        },5010)
    }
}

// Ckeditor
if(document.querySelector('#ckeditor') != null){
    ClassicEditor
    .create(document.querySelector('#ckeditor'))
    .catch(error => {
        console.error(error);
    });
}

let td_content = document.querySelectorAll('.td');
for(let i = 0; i < td_content.length; i++){
   let origin_td = td_content[i].textContent;
    if(td_content[i].textContent.length > 10){
        td_content[i].innerHTML = td_content[i].textContent.slice(0,10) + "...";
    }
    td_content[i].addEventListener('mouseenter',()=>{
        if(td_content[i].textContent.length > 10){
            let p = document.createElement('p');
            p.innerText = origin_td;
            p.classList = "popup";
            td_content[i].appendChild(p);
        }
    })
    td_content[i].addEventListener('mouseleave',()=>{
        if(td_content[i].textContent.length > 10){
            if(td_content[i].childNodes.length > 0){
                td_content[i].removeChild(td_content[i].lastElementChild);
            }
        }
    })
   
}

//Filter
if(document.querySelector('.filter_form') != null){
    const filter_btn = document.querySelector('.filter_btn');
    const filter_form = document.querySelector('.filter_form');
    const filter_icon = document.querySelector('.filter_icon');
    let dualism = "black";
    filter_btn.addEventListener('click',()=>{
        if(dualism == "black"){
            filter_form.style.display = "block";
            dualism = "white";
            filter_icon.classList = "fa-regular fa-circle-xmark filter_icon";
        }else{
            filter_form.style.display = "none";
            dualism = "black";
            filter_icon.classList = "fa-solid fa-filter filter_icon";
        }
    })
}

if(document.querySelector('#upload_image') != null){
    const upload_image = document.querySelector('#upload_image');
    const status_image = document.querySelector('#status_image');
    upload_image.addEventListener('click',()=>{
        input_image.click();
        input_image.addEventListener('change',()=>{
            if(input_image.value != null){
                status_image.style.color = "#388bff";
                status_image.innerHTML = "Đã tải lên";
            }else{
                status_image.innerHTML = "";
            }
        })
    })
    document.querySelector('.btn_update').addEventListener('click',()=>{
        sessionStorage.setItem('scrollPosition', window.pageYOffset);
    })
}

// Comments
if(document.querySelector('.comment_form_js') !== null){
    const reply_comment_btns = document.querySelectorAll('.reply_comment_btn');
    const reply_comment_form = document.querySelector('#reply_comment_form');
    const comment_form = document.querySelector('#comment_form');
    const input_reply_comment = document.querySelector('#input_reply_comment');
    const close_reply_comment_form = document.querySelector('#close_reply_comment_form');
    const name_reply = document.querySelector('#name_reply');
    const input_name_reply = document.querySelector('#input_name_reply');
    const input_focus = document.querySelector('#input_focus');
    const filter_comment_inputs = document.querySelectorAll('.filter_comment_input');
    const comment_content_items = document.querySelectorAll('.comment_content_item');
    reply_comment_btns.forEach((e)=>{
        e.addEventListener('click',()=>{
            reply_comment_form.style.display = "flex";
            comment_form.style.display = "none";
            input_reply_comment.value = e.getAttribute("id_comment");
            name_reply.innerText = e.getAttribute("name_reply");
            input_name_reply.value = e.getAttribute("name_reply");
            input_focus.scrollIntoView({behavior: "smooth"});
            setTimeout(() => {
                input_focus.focus();
            }, 500);
        })
    })
    close_reply_comment_form.addEventListener('click',()=>{
        reply_comment_form.style.display = "none";
        comment_form.style.display = "flex";
    })
    comment_content_items.forEach((e)=>{
        for (let i = 0; i < filter_comment_inputs.length; i++) {
            let filter = filter_comment_inputs[i].value;
            let text = e.textContent;
    
            // Lặp qua tất cả các lần xuất hiện của từ khóa trong nội dung
            while (text.includes(filter)) {
                text = text.replace(filter, "***");
            }
    
            // Cập nhật lại nội dung
            e.innerText = text;
        }
    })
}
// Comments Admin
const reply_btn = document.querySelectorAll('.reply_btn');
const tr_reply_comment = document.querySelectorAll('.tr_reply_comment');
reply_btn.forEach((e)=>{
    e.addEventListener('click',()=>{
        let reply_btn_id_comment = e.getAttribute('id_comment');
        if(e.textContent == "Các BL Trả Lời"){
            e.innerText = "Ẩn";
            for (let i = 0; i < tr_reply_comment.length; i++) {
                let tr_reply_comment_id_comment = tr_reply_comment[i].getAttribute('id_comment');
                if(tr_reply_comment_id_comment === reply_btn_id_comment){
                    tr_reply_comment[i].style.display = "table-row";
                }
            }
        }else{
            e.innerText = "Các BL Trả Lời";
            for (let i = 0; i < tr_reply_comment.length; i++) {
                let tr_reply_comment_id_comment = tr_reply_comment[i].getAttribute('id_comment');
                if(tr_reply_comment_id_comment === reply_btn_id_comment){
                    tr_reply_comment[i].style.display = "none";
                }
            }
        }
    })
})

// History
if(document.querySelector('.checkbox_history') !== null){
    const all_checkbox_history = document.querySelector('.all_checkbox_history');
    const checkbox_history = document.querySelectorAll('.checkbox_history');
    all_checkbox_history.addEventListener('click',()=>{
        checkbox_history.forEach((e)=>{
            if(all_checkbox_history.checked === true){
                e.checked = true;
            }else{
                e.checked = false;
            }
        })
    })
}
// Scroll
if(document.querySelector('.scroll_postion') != null){
    const scroll_postion_items = document.querySelectorAll('.scroll_postion');
    scroll_postion_items.forEach((e)=>{
        e.addEventListener('click',()=>{
            sessionStorage.setItem('scrollPosition', window.pageYOffset);
        })
    })
}
document.addEventListener("DOMContentLoaded", function() {
    let scrollPosition = sessionStorage.getItem('scrollPosition');
    if (scrollPosition !== null) {
        window.scrollTo(0, scrollPosition);
    }
    sessionStorage.removeItem('scrollPosition');
});