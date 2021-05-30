import zxcvbn from 'zxcvbn';
import {each} from 'lodash';

const insertStrengthMeterBarInContainer = (container) => {
    const passwordMeterWrapDiv = document.createElement('div');
    passwordMeterWrapDiv.classList.add('password-meter-wrap');
    const passwordMeterBarDiv = document.createElement('div');
    passwordMeterBarDiv.classList.add('password-meter-bar');
    passwordMeterWrapDiv.appendChild(passwordMeterBarDiv);
    container.appendChild(passwordMeterWrapDiv);
};

export default class PasswordStrengthMeter {

    static init() {
        const passwordInputContainers = document.querySelectorAll('[data-password-strength-meter]');
        if(passwordInputContainers.length < 1) {
            return false;
        }
        each(passwordInputContainers, (passwordInputContainer) => {
            const passwordInput = passwordInputContainer.querySelector('input[type="password"]');
            insertStrengthMeterBarInContainer(passwordInputContainer);
            let bar = passwordInputContainer.querySelector('.password-meter-bar');
            passwordInput.addEventListener('keyup', () => {
                let value = passwordInput.value;
                bar.classList.remove('level0', 'level1', 'level2', 'level3', 'level4');
                let result = zxcvbn(value);
                let cls = `level${result.score}`;
                bar.classList.add(cls);
            }, false);
        });
    }

}
