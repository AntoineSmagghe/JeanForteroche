/**
 *  Listen an icon and open a menu.
 *
 * @class menuHidden
 */

class menuHidden{
    constructor(idListen, idToShow, howToDisplay){
        this.idListen = idListen;
        this.idToShow = idToShow;
        this.howToDisplay = howToDisplay;
        this.menuIsOpen = false;
    }

    listenIco(){
        this.idListen.addEventListener("click", ()=>{
            this.idListen.style.opacity = "0";
            this.idListen.style.animation = "";
            this.idToShow.style.position = "absolute";
            this.idToShow.style.right = "0";
            this.idToShow.style.top = "0";
            this.idToShow.style.display = this.howToDisplay;
            this.idToShow.style.animation = "appearEndOfPosts .5s";
            this.menuIsOpen = true;
            this.closeMenu();
        });
    }
    
    hideMenuWhenScroll(listenEvent){
        window.removeEventListener(listenEvent, this.hideMenuWhenScroll);
    }
    
    closeMenu(){
        this.idToShow.addEventListener("mouseleave", ()=>{
            this.idToShow.style.display = "none";
            this.idListen.style.opacity = "1";
            this.idListen.style.animation = "rollNRoll .5s";
        });
        
        if (this.isMobile()){
            window.addEventListener("scroll", ()=>{
                this.idToShow.style.display = "none";
                this.idListen.style.opacity = "1";
                this.idListen.style.animation = "rollNRoll .5s";
            });
        }
    }

    isMobile() {
        let whatUser = navigator.userAgent;
        if (whatUser.match(/Android/i)
            || whatUser.match(/Iphone/i)
            || whatUser.match(/webOS/i)
            || whatUser.match(/Ipad/i)
            || whatUser.match(/Ipod/i)
            || whatUser.match(/BlackBerry/i)
            || whatUser.match(/Windows Phone/i)) {
            return true;
        } else {
            return false;
        }
    }
}