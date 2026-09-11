
const SUPABASE_CONFIG = {
    url: 'https://prfxgzttqrqbyruqctxa.supabase.co',
    anonKey: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InByZnhnenR0cXJxYnlydXFjdHhhIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODg4NTM1NjIsImV4cCI6MjEwNDQyOTU2Mn0.9zG9Kt6RPMZcUG7fEyMyX2W1bF08wfK8TE0l2OCgLF4'
};
let supabaseClient = null;
function initSupabase() {
    const isConfigured = 
        SUPABASE_CONFIG.url && 
        SUPABASE_CONFIG.anonKey && 
        SUPABASE_CONFIG.url !== 'YOUR_SUPABASE_PROJECT_URL' &&
        SUPABASE_CONFIG.anonKey !== 'YOUR_SUPABASE_ANON_KEY';

    if (isConfigured) {
        if (typeof window.supabase !== 'undefined') {
            try {
                const cleanUrl = SUPABASE_CONFIG.url.replace(/\/rest\/v1\/?$/, '').replace(/\/+$/, '');
                supabaseClient = window.supabase.createClient(cleanUrl, SUPABASE_CONFIG.anonKey);
                console.log('✅ Supabase connected successfully.');
            } catch (err) {
                console.error('❌ Failed to initialize Supabase client:', err);
            }
        } else {
            console.warn('⚠️ Supabase JS SDK not loaded yet. Make sure the SDK script is included before supabase-config.js');
        }
    } else {
        console.warn('ℹ️ Supabase credentials not set in js/supabase-config.js. Falling back to local storage.');
    }
}

function isSupabaseConfigured() {
    return supabaseClient !== null;
}

initSupabase();
