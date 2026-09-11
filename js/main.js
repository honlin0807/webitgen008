// Default website content (matching MySQL & Supabase database initial records)
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

async function fetchSiteDataFromSupabase() {
    if (typeof isSupabaseConfigured === 'function' && isSupabaseConfigured()) {
        try {
            const { data, error } = await supabaseClient
                .from('site_content')
                .select('content_key, content_value');

            if (error) {
                console.warn('Could not fetch from Supabase site_content:', error.message);
                return null;
            }

            if (data && data.length > 0) {
                const cloudData = {};
                data.forEach(row => {
                    cloudData[row.content_key] = row.content_value;
                });

                const mergedData = Object.assign({}, DEFAULT_SITE_DATA, cloudData);
                localStorage.setItem('site_content', JSON.stringify(mergedData));
                applySiteData(mergedData);
                return mergedData;
            }
        } catch (err) {
            console.error('Error fetching site_content from Supabase:', err);
        }
    }
    return null;
}

async function saveSiteData(data) {
    try {
        localStorage.setItem('site_content', JSON.stringify(data));
    } catch (e) {
        console.error('Failed to save to localStorage cache:', e);
    }

    if (typeof isSupabaseConfigured === 'function' && isSupabaseConfigured()) {
        try {
            const rows = Object.keys(data).map(key => ({
                content_key: key,
                content_value: String(data[key] || ''),
                updated_at: new Date().toISOString()
            }));

            const { error } = await supabaseClient
                .from('site_content')
                .upsert(rows, { onConflict: 'content_key' });

            if (error) {
                console.error('Supabase upsert error:', error);
                return { success: false, error: error.message, cloud: false };
            }

            return { success: true, cloud: true };
        } catch (err) {
            console.error('Failed to save to Supabase:', err);
            return { success: false, error: err.message, cloud: false };
        }
    }

    return { success: true, cloud: false };
}

function applySiteData(customData) {
    const data = customData || getSiteData();
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

function initPageContent() {

    applySiteData();

    fetchSiteDataFromSupabase();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPageContent);
} else {
    initPageContent();
}
