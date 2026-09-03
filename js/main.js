// Default website content (matching MySQL database initial records)
const DEFAULT_SITE_DATA = {
    company_name: 'NEIVCE Trading PLT',
    announcement: 'Welcome to NEIVCE Trading PLT.',
    introduction: 'NEIVCE Trading PLT provides e-commerce, computer programming services and computer training.',
    about: 'NEIVCE Trading PLT is based in Kajang, Selangor. We provide practical digital services and training for customers.',
    mission: 'To provide useful and affordable digital services.',
    vision: 'To be a trusted local digital service provider.',
    values: 'Good service, honesty and continuous learning.',
    ecommerce: 'We help businesses with online selling and e-commerce activities.',
    programming: 'We create simple websites and computer programs for business needs.',
    training: 'We provide basic computer training for students and adults.',
    address: 'B5 - B7, Block B, Jalan TKS 1, Taman Kajang Sentral, 43000 Kajang, Selangor',
    telephone: '03-8737 8770',
    contact_about: 'NEIVCE Trading PLT provides e-commerce, computer programming services and computer training.'
};

// Retrieve content from localStorage or fallback to defaults
function getSiteData() {
    try {
        const saved = localStorage.getItem('site_content');
        if (saved) {
            return Object.assign({}, DEFAULT_SITE_DATA, JSON.parse(saved));
        }
    } catch (e) {
        console.error('Failed to parse site_content from localStorage:', e);
    }
    return Object.assign({}, DEFAULT_SITE_DATA);
}

// Save content to localStorage
function saveSiteData(data) {
    try {
        localStorage.setItem('site_content', JSON.stringify(data));
        return true;
    } catch (e) {
        console.error('Failed to save site_content to localStorage:', e);
        return false;
    }
}

// Apply content dynamically to HTML elements with data-content attribute
function applySiteData() {
    const data = getSiteData();
    document.querySelectorAll('[data-content]').forEach(el => {
        const key = el.getAttribute('data-content');
        if (data[key] !== undefined) {
            if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
                el.value = data[key];
            } else {
                el.textContent = data[key];
            }
        }
    });
}

// Auto-run applySiteData when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', applySiteData);
} else {
    applySiteData();
}
