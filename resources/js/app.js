import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const steps = document.querySelectorAll('.form-step');
    if (!steps.length) return;

    let current = 0;
    const progress = document.getElementById('progress');

    const showStep = (i) => {
        steps.forEach((step, idx) => step.classList.toggle('hidden', idx !== i));
        if (progress) {
            progress.textContent = `Langkah ${i + 1} dari ${steps.length}`;
        }
    };

    document.querySelectorAll('[data-next]').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            if (current < steps.length - 1) {
                current++;
                showStep(current);
            }
        });
    });

    document.querySelectorAll('[data-prev]').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            if (current > 0) {
                current--;
                showStep(current);
            }
        });
    });

    showStep(current);
});