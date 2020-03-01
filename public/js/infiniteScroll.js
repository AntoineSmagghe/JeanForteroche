class infiniteScroll {
    constructor(url){
        this.scroll = true;
        this.timer = null;
        this.numberLoad = 2;
        this.isAllreadyScrolled = true;
        this.url = url;
        this.scrollFrom = 150;
    }

    callPosts(data){
        if (this.isAllreadyScrolled){
            ajaxPost(this.url, data, (ret)=>{
                try{
                    let returnData = JSON.parse(ret);
                    let titleElt = document.createElement("h3");
                    titleElt.textContent = returnData.title[0];
                    
                    let dateElt = document.createElement("span");
                    dateElt.setAttribute("class", "info_date");
                    dateElt.innerHTML = " rédigé " + returnData.date[0];
                    
                    let textElt = document.createElement("p");
                    textElt.innerHTML = returnData.text[0];
                    
                    let returnElt = document.createElement("div");
                    returnElt.setAttribute("class", "post_content post_home_view");
                    
                    let linkToPost = document.createElement("a");
                    linkToPost.setAttribute("href", "index.php?pge=article&action=show&idPost=" + returnData.id[0]);
                    linkToPost.setAttribute("class", "width75");
    
                    let homePageArticle = document.createElement("div");
                    homePageArticle.setAttribute("class", "home_page_article");
    
                    titleElt.appendChild(dateElt);
                    returnElt.appendChild(titleElt);
                    returnElt.appendChild(textElt);
                    linkToPost.appendChild(returnElt);
                    homePageArticle.appendChild(linkToPost);
    
                    document.getElementById("home_page").appendChild(homePageArticle);
                }catch{
                    if (this.isAllreadyScrolled){
                        let endOfPosts = document.createElement("p");
                        endOfPosts.setAttribute("id", "end_of_posts");
                        endOfPosts.textContent = "Fin des Billets";
                        document.getElementById("home_page").appendChild(endOfPosts);
                        this.isAllreadyScrolled = false;
                    }
                }
            });
        }
    }

    loadElt(){
        window.addEventListener("scroll", ()=>{
            if(this.isMobile()){
                this.scrollFrom = 500;
            }

            if ((window.innerHeight + window.scrollY + this.scrollFrom) >= document.body.offsetHeight){
                if (this.timer !== null){
                    window.clearTimeout(this.time);
                    this.timer = null;
                }else {
                    this.timer = setTimeout(() => { 
                        this.scroll = true; 
                    }, 50);
                }
                
                if(this.scroll){
                    this.numberLoad++;
                    let data = new FormData();
                    data.append("numberLoad", this.numberLoad);
                    this.callPosts(data);
                    this.scroll = false;
                }
            }
        });
    }

    isMobile(){
        let whatUser = navigator.userAgent;
        if (whatUser.match(/Android/i) 
        || whatUser.match(/Iphone/i)
        || whatUser.match(/webOS/i)
        || whatUser.match(/Ipad/i)
        || whatUser.match(/Ipod/i)
        || whatUser.match(/BlackBerry/i)
        || whatUser.match(/Windows Phone/i)){
            return true;
        }else{
            return false;
        }
    }
}
