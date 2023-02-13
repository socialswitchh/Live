<link rel="stylesheet" href="assets/css/app.css">
<link rel="stylesheet" href="assets/css/core.css">
<link rel="stylesheet" href="assets/css/custom.css">
<style>

@media (max-width: 599px){
    .fancybox-custom-layout .fancybox-stage{
        position:relative;
        height:240px;
        right:0;
        left:0;
        top:0;
        z-index:99
    }
    .fancybox-custom-layout .fancybox-slide{
        padding:0 !important;
        width:calc(100% - 44px) !important
    }
    .fancybox-custom-layout .fancybox-slide .fancybox-content{
        width:100% !important
    }
    .fancybox-custom-layout .fancybox-slide .fancybox-content img{
        margin:0 20px !important;
        max-width:calc(100% - 40px) !important;
        -o-object-fit:cover !important;
        object-fit:cover !important;
    }
    .fancybox-custom-layout .fancybox-caption{
        width:calc(100% - 44px) !important;
        height:calc(100% - 240px) !important;
        top:240px !important;
    }
}
.fancybox-custom-layout .fancybox-bg{
    background:#5596e6
}
.fancybox-custom-layout .fancybox-slide{
    background:#181e28;
    padding:0 40px
}
.fancybox-custom-layout .fancybox-slide img{
    border-radius:6px
}
.fancybox-custom-layout .fancybox-custom-layout.fancybox-is-open .fancybox-bg{
    opacity:1
}
.fancybox-custom-layout .fancybox-caption{
    background:#fff;
    bottom:0;
    color:#6c6f73;
    left:auto;
    padding:10px 0;
    right:44px;
    top:0;
    width:350px;
    text-align:left
}
.fancybox-custom-layout .fancybox-caption:before{
    display:none
}
.fancybox-custom-layout .fancybox-caption .fancybox-caption__body{
    position:absolute;
    top:0;
    left:0;
    height:100%;
    padding-bottom:50px
}
.fancybox-custom-layout .fancybox-caption a{
    text-decoration:none
}
.fancybox-custom-layout .fancybox-caption a:hover{
    color:#5596e6
}
.fancybox-custom-layout .fancybox-caption .comment-controls{
    position:absolute;
    bottom:0;
    left:0;
    background:#fbfbfc;
    height:50px;
    width:100%;
    border-radius:0 0 6px 0;
    border-top:1px solid #dee2e5
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner{
    position:relative;
    display:flex;
    align-items:center;
    width:100%;
    height:100%;
    padding:0 16px
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner img{
    height:32px;
    width:32px;
    border-radius:50%
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .control{
    position:relative;
    width:100%
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .control .textarea,.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .control .emojionearea-editor{
    resize:none;
    height:36px;
    max-height:36px;
    min-height:36px;
    border-radius:100px;
    overflow:hidden;
    line-height:1.6;
    font-size:.8rem;
    padding-left:16px;
    margin:0 6px;
    text-align:left
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .control .emoji-button{
    position:absolute;
    top:0;
    right:0;
    height:36px;
    width:36px;
    display:flex;
    justify-content:center;
    align-items:center;
    background:none;
    border:none;
    outline:none;
    transition:all .3s;
    cursor:pointer
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .control .emoji-button:hover svg{
    stroke:#3d70b2
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .control .emoji-button svg{
    height:16px;
    width:16px;
    stroke:#a2a5b9;
    transition:all .3s
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea-editor{
    padding-left:0 !important
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea-editor img{
    height:18px;
    width:18px;
    min-height:18px;
    max-height:18px
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea{
    overflow:visible !important
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea-picker{
    top:-230px;
    position:absolute;
    left:-50px;
    width:310px
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea-picker .emojionearea-wrapper{
    width:310px
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea-picker .emojionearea-wrapper img{
    height:22px;
    width:22px;
    min-height:22px;
    max-height:22px
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea-scroll-area{
    width:310px
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea .emojionearea-button>div.emojionearea-button-open{
    background-position:0 -22px
}
.fancybox-custom-layout .fancybox-caption .comment-controls .controls-inner .emojionearea .emojionearea-picker .emojionearea-scroll-area .emojibtn{
    width:24px !important;
    height:24px !important
}
.fancybox-custom-layout .fancybox-caption .header{
    display:flex;
    justify-content:flex-start;
    align-items:center;
    padding:12px;
    width:100%
}
.fancybox-custom-layout .fancybox-caption .header img{
    height:42px;
    width:42px;
    border-radius:50%
}
.fancybox-custom-layout .fancybox-caption .header .user-meta{
    margin:0 10px
}
.fancybox-custom-layout .fancybox-caption .header .user-meta span{
    display:block
}
.fancybox-custom-layout .fancybox-caption .header .user-meta span:first-child{
    font-size:.9rem;
    font-weight:500
}
.fancybox-custom-layout .fancybox-caption .header .user-meta span:first-child small{
    color:#999
}
.fancybox-custom-layout .fancybox-caption .header .user-meta span:nth-child(2){
    text-align:left;
    font-size:.8rem;
    color:#999
}
.fancybox-custom-layout .fancybox-caption .header .button{
    line-height:0;
    margin-left:auto;
    padding:14px 18px
}
.fancybox-custom-layout .fancybox-caption .header .dropdown .button{
    padding:18px 6px;
    border:none;
    background:transparent
}
.fancybox-custom-layout .fancybox-caption .header .dropdown .button svg{
    height:18px;
    width:18px
}
.fancybox-custom-layout .fancybox-caption .header .dropdown .dropdown-menu{
    margin-top:10px
}
.fancybox-custom-layout .fancybox-caption .inner-content{
    padding:12px
}
.fancybox-custom-layout .fancybox-caption .inner-content .control{
    width:100%
}
.fancybox-custom-layout .fancybox-caption .inner-content .control input{
    padding-left:34px
}
.fancybox-custom-layout .fancybox-caption .inner-content .control input:focus+.icon svg{
    stroke:#5596e6
}
.fancybox-custom-layout .fancybox-caption .inner-content .control .icon{
    position:absolute;
    top:0;
    left:0;
    height:32px;
    width:32px;
    display:flex;
    justify-content:center;
    align-items:center
}
.fancybox-custom-layout .fancybox-caption .inner-content .control .icon svg{
    height:18px;
    width:18px;
    stroke:#cecece;
    transition:all .3s
}
.fancybox-custom-layout .fancybox-caption .live-stats{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 0 20px 0;
    border-bottom:1px solid #e8e8e8
}
.fancybox-custom-layout .fancybox-caption .live-stats .social-count{
    display:flex;
    align-items:stretch
}
.fancybox-custom-layout .fancybox-caption .live-stats .social-count .shares-count,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .comments-count,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .likes-count,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .views-count{
    display:flex;
    justify-content:flex-start;
    align-items:center;
    margin:0 3px
}
.fancybox-custom-layout .fancybox-caption .live-stats .social-count .shares-count span,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .comments-count span,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .likes-count span,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .views-count span{
    display:block;
    font-size:.8rem;
    color:#888da8;
    margin:0 5px
}
.fancybox-custom-layout .fancybox-caption .live-stats .social-count .shares-count span.views,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .comments-count span.views,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .likes-count span.views,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .views-count span.views{
    margin:0 2px
}
.fancybox-custom-layout .fancybox-caption .live-stats .social-count .shares-count svg,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .comments-count svg,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .likes-count svg,.fancybox-custom-layout .fancybox-caption .live-stats .social-count .views-count svg{
    height:14px;
    width:14px;
    stroke:#888da8
}
.fancybox-custom-layout .fancybox-caption .actions{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:12px 0 0 0
}
.fancybox-custom-layout .fancybox-caption .actions .action{
    display:flex;
    justify-content:center;
    align-items:center;
    cursor:pointer
}
.fancybox-custom-layout .fancybox-caption .actions .action span{
    display:block;
    font-size:.8rem;
    margin:0 4px;
    transition:all .3s
}
.fancybox-custom-layout .fancybox-caption .actions .action svg{
    height:16px;
    width:16px;
    stroke:#888da8;
    transition:all .3s
}
.fancybox-custom-layout .fancybox-caption .actions .action:hover span{
    color:#5596e6
}
.fancybox-custom-layout .fancybox-caption .actions .action:hover svg{
    stroke:#5596e6
}
.fancybox-custom-layout .fancybox-caption .comments-list{
    background:#f5f6f7;
    height:calc(100% - 162px);
    padding:20px 14px;
    overflow-y:auto
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment{
    border:none !important;
    padding-top:0 !important
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment.is-nested{
    margin-left:40px
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-left{
    margin-right:10px
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-left img{
    border-radius:50%
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content{
    background:#fff;
    padding:12px;
    border-radius:8px
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .username{
    font-size:.8rem;
    font-weight:500
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content p{
    font-size:.75rem;
    color:#999
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions{
    display:flex;
    align-items:center;
    padding-top:8px
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions span,.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions a{
    display:block;
    font-size:.75rem
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions span{
    margin:0 10px;
    color:#999
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions .likes-count{
    display:flex;
    justify-content:flex-start;
    align-items:center;
    margin-left:auto
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions .likes-count span{
    display:block;
    font-size:.75rem;
    color:#888da8;
    margin:0 5px
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions .likes-count span.views{
    margin:0 2px
}
.fancybox-custom-layout .fancybox-caption .comments-list .is-comment .media-content .comment-actions .likes-count svg{
    height:12px;
    width:12px;
    stroke:#888da8
}
.fancybox-custom-layout .fancybox-stage{
    right:394px
}
.fancybox-custom-layout .fancybox-toolbar{
    background:#5596e6;
    bottom:0;
    left:auto;
    right:0;
    top:0;
    width:44px
}
.fancybox-custom-layout .fancybox-button{
    background:transparent
}
.fancybox-custom-layout .fancybox-button div{
    padding:2px
}
.fancybox-custom-layout .fancybox-button[disabled]{
    color:#fff
}
.fancybox-custom-layout .fancybox-button:not([disabled]){
    color:#fff
}
.fancybox-custom-layout .fancybox-button--arrow_right{
    right:308px
}
    </style>
<style>
        .star-rating { 
            display: flex;
            flex-direction: row-reverse;
            font-size: 1.3em;
            justify-content: space-around;
            padding: 0 .2em;
            text-align: center;
            width: 6em;
            margin-top:5px;
            margin-left: -7px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ccc;
            cursor: pointer;
        }

        .star-rating :checked~label {
            color: #6ba4e9;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #6ba4e9;
        }

        /* explanation */

        article {
            background-color: #ffe;
            box-shadow: 0 0 1em 1px rgba(0, 0, 0, .25);
            color: #006;
            font-family: cursive;
            font-style: italic;
            margin: 4em;
            max-width: 30em;
            padding: 2em;
        }
        .photo-modal-rating-box{
            display: flex;
        }
    </style>

<div class="fancybox-container fancybox-custom-layout fancybox-show-toolbar fancybox-show-caption fancybox-is-open fancybox-is-zoomable fancybox-can-zoomIn" role="dialog" tabindex="-1" id="fancybox-container-1" style="transition-duration: 366ms;"><div class="fancybox-bg"></div><div class="fancybox-inner"><div class="fancybox-infobar"><span data-fancybox-index="">1</span>&nbsp;/&nbsp;<span data-fancybox-count="">1</span></div><div class="fancybox-toolbar"><button data-fancybox-close="" class="fancybox-button fancybox-button--close" title="Close"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 10.6L6.6 5.2 5.2 6.6l5.4 5.4-5.4 5.4 1.4 1.4 5.4-5.4 5.4 5.4 1.4-1.4-5.4-5.4 5.4-5.4-1.4-1.4-5.4 5.4z"></path></svg></button><button data-fancybox-thumbs="" class="fancybox-button fancybox-button--thumbs" title="Thumbnails" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M14.59 14.59h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76h-3.76v-3.76zm-4.47 0h3.76v3.76H5.65v-3.76zm8.94-4.47h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76h-3.76V5.65zm-4.47 0h3.76v3.76H5.65V5.65z"></path></svg></button><button data-fancybox-share="" class="fancybox-button fancybox-button--share" title="Share"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M2.55 19c1.4-8.4 9.1-9.8 11.9-9.8V5l7 7-7 6.3v-3.5c-2.8 0-10.5 2.1-11.9 4.2z"></path></svg></button></div><div class="fancybox-navigation"><button data-fancybox-prev="" class="fancybox-button fancybox-button--arrow_left" title="Previous" disabled=""><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M11.28 15.7l-1.34 1.37L5 12l4.94-5.07 1.34 1.38-2.68 2.72H19v1.94H8.6z"></path></svg></div></button><button data-fancybox-next="" class="fancybox-button fancybox-button--arrow_right" title="Next" disabled=""><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.4 12.97l-2.68 2.72 1.34 1.38L19 12l-4.94-5.07-1.34 1.38 2.68 2.72H5v1.94z"></path></svg></div></button></div><div class="fancybox-stage"><div class="fancybox-slide fancybox-slide--image fancybox-slide--current fancybox-slide--complete" style=""><div class="fancybox-content" style="transform: translate(303px, 0px); width: 347.356px; height: 464px;"><img class="fancybox-image" src="server/uploads/16718126398981345281800813373011.jpg"></div></div></div><div class="fancybox-caption"><div class="fancybox-caption__body">
            <div class="header">
                <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/stella.jpg" alt="">
                <div class="user-meta">
                    <span>Stella Bergmann</span>
                    <span><small>Yesterday</small></span>
                </div>
                <button type="button" class="button">Follow</button>
                <div class="dropdown is-spaced is-right dropdown-trigger">
                    <div>
                        <div class="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                        </div>
                    </div>
                    <div class="dropdown-menu" role="menu">
                        <div class="dropdown-content">
                            <div class="dropdown-item is-title has-text-left">
                                Who can see this ?
                            </div>
                            <a href="#" class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                                    <div class="media-content">
                                        <h3>Public</h3>
                                        <small>Anyone can see this publication.</small>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <div class="media-content">
                                        <h3>Friends</h3>
                                        <small>only friends can see this publication.</small>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <div class="media-content">
                                        <h3>Specific friends</h3>
                                        <small>Don't show it to some friends.</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item">
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <div class="media-content">
                                        <h3>Only me</h3>
                                        <small>Only me can see this publication.</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner-content">
                <div class="live-stats">
                    <div class="social-count">
                        <div class="likes-count">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            <span>33</span>
                        </div>
                        <div class="comments-count">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                            <span>9</span>
                        </div>
                    </div>
                    <div class="social-count ml-auto">
                        <div class="views-count">
                            <span>9</span>
                            <span class="views"><small>comments</small></span>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <div class="action">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                        <span>Like</span>
                    </div>
                    <div class="action">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        <span>Comment</span>
                    </div>
                </div>
            </div>

            <div class="comments-list has-slimscroll">
              

                <div class="media is-comment"> 
                <div class="media-left">
                    <div class="image">
                        <img src="./upload/user/1671766912i switchh logo.jpg" data-user-popover="1" alt="" style="width:30px;"> 
                    </div>
                </div> 
                <div class="media-content"><a href="main_user_profile.php?user_id=1">lakshmi kapur</a>
        				<span class="time">@lakshmi651362</span><p>mast</p> 
                    <div class="controls photo-modal-rating-box"><div class="star-rating"><div class="like-count" style="margin: -12px 0px -12px 0px;">
            			    <input class="cr_click" type="radio" name="rating" value="1" id="1-stars61" data-rcommentid="61" data-rcommentuid="1" data-postid="14">
                            <label for="1-stars61" class="star">★</label>    
                            <input class="cr_click" type="radio" name="rating" value="2" id="2-stars61" data-rcommentid="61" data-rcommentuid="1" data-postid="14"> 
                            <label for="2-stars61" class="star">★</label> 
                            <input class="cr_click" type="radio" name="rating" value="3" id="3-stars61" data-rcommentid="61" data-rcommentuid="1" data-postid="14">
                            <label for="3-stars61" class="star">★</label> 
                            <input class="cr_click" type="radio" name="rating" value="4" id="4-stars61" data-rcommentid="61" data-rcommentuid="1" data-postid="14">
                            <label for="4-stars61" class="star">★</label> 
                            <input class="cr_click" type="radio" name="rating" value="5" id="5-star61" data-rcommentid="61" data-rcommentuid="1" data-postid="14">
                            <label for="5-star61" class="star">★</label>
                		</div>
                		</div>
                		<div>
                    		<div class="like-count" style="font-size: small;margin: 0 2px -15px 5px;"> 
                                <div class="average_rating_show" style="display: none;"></div>
                                <h3 class="average_rating_hide"> 4.0/5 </h3>
                            </div>
                            
                            <div class="reply post_comment" id="61" data-userid="1" style="margin: 0 0 0 48px;"> 
        						<a href="#mainForm">Reply</a>
        					</div> 
    					</div>
                    </div>
                    <div class="media is-comment"> 
            <div class="media-left">
                <div class="image">
                     <img src="./upload/user/1671815057w-logo-blue.png" data-user-popover="1" alt="" style="width:30px;">
                </div>
            </div> 
            <div class="media-content"><a href="main_user_profile.php?user_id=3">Mukesh Jha</a>
        				<span class="time">@Mukesh818615</span><p>@lakshmi kapur Thanks😍</p>  
                <div class="controls photo-modal-rating-box">
                        <div class="star-rating cls_comment_rating" id="cls_comment_rating">
                            <div class="like-count" style="margin: -12px 0px -12px 0px;">
                                <input class="cr_click" type="radio" name="rating" value="1" id="1-stars94" data-rcommentid="94" data-rcommentuid="3" data-postid="14">
                                <label for="1-stars94" class="star">★</label>    
                                <input class="cr_click" type="radio" name="rating" value="2" id="2-stars94" data-rcommentid="94" data-rcommentuid="3" data-postid="14"> 
                                <label for="2-stars94" class="star">★</label> 
                                <input class="cr_click" type="radio" name="rating" value="3" id="3-stars94" data-rcommentid="94" data-rcommentuid="3" data-postid="14">
                                <label for="3-stars94" class="star">★</label> 
                                <input class="cr_click" type="radio" name="rating" value="4" id="4-stars94" data-rcommentid="94" data-rcommentuid="3" data-postid="14">
                                <label for="4-stars94" class="star">★</label> 
                                <input class="cr_click" type="radio" name="rating" value="5" id="5-star94" data-rcommentid="94" data-rcommentuid="3" data-postid="14">
                                <label for="5-star94" class="star">★</label>
            		        </div>
            		    </div>
            	<div>
                		<div class="like-count" style="font-size: small;margin: 0 2px -15px 5px;"> 
                             <div class="average_rating_show" style="display: none;"></div>
                            <h3 class="average_rating_hide"> 0/5 </h3> 
                        </div>
                    
                    <div class="reply post_comment" id="94" data-userid="3" style="margin: 0 0 0 48px;"> 
						<a href="#mainForm">Reply</a>
					</div> 
					</div>
                </div>
            </div> 
        </div>
    </div> 
            </div>

            </div>

            

            <div class="comment-controls has-lightbox-emojis">
                <div class="controls-inner" id="lightbox-post-comment-wrapper-1">
                    <img src="https://via.placeholder.com/300x300" data-demo-src="assets/img/avatars/jenna.png" alt="">
                    <div class="control">
                        <textarea class="textarea comment-textarea is-rounded" rows="1" id="lightbox-post-comment-textarea-1"></textarea>
                        <button class="emoji-button" id="lightbox-post-comment-button-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smile"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div></div></div></div>