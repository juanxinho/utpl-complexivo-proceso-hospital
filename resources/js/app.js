import './bootstrap';
import 'flowbite';

window.themeSwitcher = function () {
    return {
        switchOn: JSON.parse(localStorage.getItem('isDark')) || false,
        switchTheme() {
            if (this.switchOn) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
            localStorage.setItem('isDark', this.switchOn)
        }
    }
}

document.addEventListener('livewire:initialized', function () {
    Livewire.on('flashMessage', data => {
        window.dispatchEvent(new CustomEvent('banner-message', {
            detail: data
        }));
    });
});

