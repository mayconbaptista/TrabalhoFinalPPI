// link do video https://www.youtube.com/watch?v=bHRXRYTppHM

class MobileNavbar {
    constructor() {
      this.mobileMenu = document.querySelector(".mobile-menu");
      this.navList = document.querySelector(".nav-list");
      this.navLinks = document.querySelectorAll(".nav-list li");
      this.activeClass = "active";
  
      this.handleClick = this.handleClick.bind(this);
    }
  
    animateLinks() 
    {
      this.navLinks.forEach((link, index) => {
        link.style.animation
          ? (link.style.animation = "")
          : (link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3}s`);
      });
    }
  
    handleClick() {
        this.navList.classList.toggle(this.activeClass);
        this.mobileMenu.classList.toggle(this.activeClass);
        this.animateLinks();
    }
  
    addClickEvent() 
    {
        this.mobileMenu.addEventListener("click", this.handleClick);
    }
  
    init() 
    {
        if (this.mobileMenu)
        {
            this.addClickEvent();
        }
      return this;
    }
}
  
const mobileNavbar = new MobileNavbar();
  
mobileNavbar.init();
  