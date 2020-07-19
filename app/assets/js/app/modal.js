export default class Modal {

    constructor() {
        var context = this;

        this.modal = document.querySelector('.modal');
        document.body.appendChild(this.modal);
        this.overlay = document.querySelector('.modal__overlay');
        this.closer = document.querySelector('.modal__close');

        this.overlay.addEventListener('click', function (e) {
            if(e.target !== context.overlay) return;
            context.hide();
        });
        this.closer.addEventListener('click', function (e) {
            if(e.target !== context.closer) return;
            context.hide();
        });
    }

    show() {
        var context = this;
        this.modal.style.display = 'block';
        this.modal.classList.add('fa_modal_enter');
        this.waitForPrevRender(function () {
            context.modal.classList.add('fa_modal_enter_active');
            context.modal.classList.remove('fa_modal_enter');
        });
        this.overlay.addEventListener('transitionend', function () {
            context.modal.classList.remove('fa_modal_enter_active');
        }, { once: true });
    }

    hide() {
        var context = this;
        this.modal.classList.add('fa_modal_leave_active')
        this.overlay.addEventListener('transitionend', function () {
            context.modal.style.display = 'none';
            context.modal.classList.remove('fa_modal_leave_active')
        }, { once: true });
    }

    waitForPrevRender(fn) {
        window.requestAnimationFrame(function () {
            window.requestAnimationFrame(function () {
                fn();
            })
        })
    }
}