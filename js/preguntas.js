
// Accordion functionality
document.querySelectorAll('[data-accordion-target]').forEach(button => {
    button.addEventListener('click', () => {
        const target = document.querySelector(button.getAttribute('data-accordion-target'));
        const isOpen = !target.classList.contains('hidden');
        
        // Toggle visibility
        target.classList.toggle('hidden', isOpen);
        button.setAttribute('aria-expanded', !isOpen);
        button.querySelector('[data-accordion-icon]').classList.toggle('rotate-[180deg]', !isOpen);
    });
});

// Search functionality
document.getElementById('search-button').addEventListener('click', () => {
    const question = document.getElementById('question-input').value.toLowerCase();
    const faqs = document.querySelectorAll('#accordion-collapse h2');

    let found = false;

    faqs.forEach((faq, index) => {
        const questionText = faq.innerText.toLowerCase();
        if (questionText.includes(question)) {
            found = true;
            
            // Open the corresponding FAQ section
            const body = document.querySelector(`#accordion-collapse-body-${index + 1}`);
            body.classList.remove('hidden');

            // Optionally scroll to the opened FAQ
            body.scrollIntoView({ behavior: 'smooth', block: 'center' });
            
            // Highlight the matched question (optional)
            faq.classList.add('bg-yellow-200'); // Add a highlight color
        } else {
            // Remove highlight if not matched
            faq.classList.remove('bg-yellow-200');
        }
    });

    if (!found) {
        alert(`No matching questions found for: ${question}`);
    }
});