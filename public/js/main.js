
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

// Comment
function comments(){
    if(document.querySelector('.comment_form_js') !== null){
        const reply_comment_btns = document.querySelectorAll('.reply_comment_btn');
        const reply_comment_form = document.querySelector('#reply_comment_form');
        const comment_form = document.querySelector('#comment_form');
        const input_reply_comment = document.querySelector('#input_reply_comment');
        const close_reply_comment_form = document.querySelector('#close_reply_comment_form');
        const name_reply = document.querySelector('#name_reply');
        const input_name_reply = document.querySelector('#input_name_reply');
        const input_focus = document.querySelector('#reply_comment_value');
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
}
comments();

//  Ajax
if(document.querySelector('#comment_content') != null){
    const comment_content = document.querySelector('#comment_content');
    const id_news = comment_content.getAttribute('id_news');
    const time = setInterval(() => {
        // console.log('cc');
        var xhr = new XMLHttpRequest();
        xhr.open('POST',`/ajax-comments/${id_news}`, true);
        // Thêm CSRF token vào header
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.onload = function(){
            //HTTP statuses
            //200: "OK"
            //403: "Forbidden"
            //404: "Not Found"
            if(this.status == 200){
                comment_content.innerHTML = "";
                const data = JSON.parse(this.responseText);
                data.comments.forEach(comment => {
                    const user = data.users.find(u => u.id === comment.id_user);
    
                    const commentElement = document.createElement('div');
                    commentElement.classList.add('item');
                    
                    // HTML của bình luận
                    commentElement.innerHTML = `
                        <div class="comment">
                            <div class="image">
                                ${user ? `<img src="/images/${user.image}" alt="">` : ''}
                            </div>
                            <div>
                                <h3>
                                    ${user ? user.name : ''} 
                                    ${user && user.role === "admin" ? '(Admin)' : ''} 
                                    ${user && user.role === "staff" ? '(Nhân viên)' : ''}
                                </h3>
                                <p class="comment_content_item">${comment.content}</p>
                                <span class="reply_comment_btn" id_comment="${comment.id}" name_reply="${user.name}">Trả lời</span>
                            </div>
                            ${comment.id_user === data.auth_user_id ? 
                                `<button class="delete_btn delete_comment_btn" news_id="${comment.id_news}" item_delete=${comment.id}><i class="fa-solid fa-minus"></i></button>`
                                : ''
                            }
                        </div>
                    `;
    
                    // Xử lý các bình luận trả lời
                    data.reply_comments.forEach(reply_comment => {
                        if (reply_comment.id_comment === comment.id) {
                            const reply_user = data.users.find(u => u.id === reply_comment.id_user);
    
                            const replyElement = document.createElement('div');
                            replyElement.classList.add('reply_comment');
                            replyElement.innerHTML = `
                                <div class="image">
                                    ${reply_user ? `<img src="/images/${reply_user.image}" alt="">` : ''}
                                </div>
                                <div>
                                    <h3>
                                        ${reply_user ? reply_user.name : ''} 
                                        ${reply_user && reply_user.role === "admin" ? '(Admin)' : ''} 
                                        ${reply_user && reply_user.role === "staff" ? '(Nhân viên)' : ''}
                                    </h3>
                                    <div class="reply_comment_content">
                                        <strong>${reply_comment.name_reply}</strong>
                                        <p class="comment_content_item">${reply_comment.content}</p>
                                    </div>
                                    <span class="reply_comment_btn" id_comment="${comment.id}" name_reply="${reply_user.name}">Trả lời</span>
                                </div>
                                ${reply_comment.id_user === data.auth_user_id ? 
                                    `<button class="delete_btn delete_reply_comment_btn" news_id="${reply_comment.id_news}" item_delete=${reply_comment.id}><i class="fa-solid fa-minus"></i></button>`
                                    : ''
                                }
                            `;
                            commentElement.appendChild(replyElement);
                        }
                    });
    
                    // Thêm bình luận vào container
                    comment_content.appendChild(commentElement);
                });
                // Gán lại sự kiện xóa sau khi cập nhật bình luận
                assignDeleteEventHandlers();
            }
        comments();
        }
        //Send request
        xhr.send();
// delete comment

    }, 1000);
}
function assignDeleteEventHandlers(){
    const delete_comment_btns = document.querySelectorAll('.delete_comment_btn');
    delete_comment_btns.forEach((e)=>{
        let id = e.getAttribute('news_id');
        let id_delete = e.getAttribute('item_delete');
        e.addEventListener('click',()=>{
            if(confirm('Bạn có muốn xóa bình luận này không?')){
                fetch(`/comment/${id}/delete/${id_delete}`,{
                    method:'DELETE',
                    headers:{
                        'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .catch(error => console.error(error));
            }
        })
    })
    const delete_reply_comment_btns = document.querySelectorAll('.delete_reply_comment_btn');
    delete_reply_comment_btns.forEach((e)=>{
        let id = e.getAttribute('news_id');
        let id_delete = e.getAttribute('item_delete');
        e.addEventListener('click',()=>{
            if(confirm('Bạn có muốn xóa bình luận này không?')){
                fetch(`/reply_comment/${id}/delete/${id_delete}`,{
                    method:'DELETE',
                    headers:{
                        'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .catch(error => console.error(error));
            }
        })
    })
}

const btn_send_comment = document.querySelector("#btn_send_comment");
const btn_send_reply_comment = document.querySelector("#btn_send_reply_comment");
const comment_value = document.querySelector("#comment_value");
const reply_comment_value = document.querySelector("#reply_comment_value");
btn_send_comment.addEventListener('click',(e)=>{
    e.preventDefault();
    let id = comment_value.getAttribute("news_id");
    let value = comment_value.value;
    fetch(`/comment/${id}`,{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            comment: value
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            comment_value.value = "";
        }else{
            console.log("fail");
        }
    })
    .catch(error => console.error(error));
})
btn_send_reply_comment.addEventListener('click',(e)=>{
    e.preventDefault();
    let id = reply_comment_value.getAttribute("news_id");
    let value = reply_comment_value.value;
    let replyCommentId = input_reply_comment.value; // ID của bình luận bạn đang trả lời
    let nameReply = input_name_reply.value; // Tên người trả lời
    fetch(`/reply_comment/${id}`,{
        method: 'POST',
        headers:{
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            comment: value,
            id_comment: replyCommentId,
            name_reply: nameReply
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            reply_comment_value.value = "";
            document.querySelector('#close_reply_comment_form').click();
        }else{
            console.log("fail");
        }
    })
    .catch(error => console.error(error));
})

