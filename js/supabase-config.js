// ==============================================================================
// Supabase Configuration for NEIVCE Trading PLT
// ==============================================================================
// Instructions:
// 1. Go to your Supabase Project: https://supabase.com/dashboard
// 2. Click "Project Settings" (gear icon) -> "API"
// 3. Copy "Project URL" and paste it into SUPABASE_URL below.
// 4. Copy "anon public" key and paste it into SUPABASE_ANON_KEY below.
// ==============================================================================

const SUPABASE_CONFIG = {
    // Replace with your Project URL, e.g. 'https://xyzcompany.supabase.co'
    url: 'https://prfxgzttqrqbyruqctxa.supabase.co',

    // Replace with your anon public API key, e.g. 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...'
    anonKey: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InByZnhnenR0cXJxYnlydXFjdHhhIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODg4NTM1NjIsImV4cCI6MjEwNDQyOTU2Mn0.9zG9Kt6RPMZcUG7fEyMyX2W1bF08wfK8TE0l2OCgLF4'
};

// Global Supabase client instance
let supabaseClient = null;

// Initialize Supabase client if credentials are configured
function initSupabase() {
    const isConfigured = 
        SUPABASE_CONFIG.url && 
        SUPABASE_CONFIG.anonKey && 
        SUPABASE_CONFIG.url !== 'YOUR_SUPABASE_PROJECT_URL' &&
        SUPABASE_CONFIG.anonKey !== 'YOUR_SUPABASE_ANON_KEY';

    if (isConfigured) {
        if (typeof window.supabase !== 'undefined') {
            try {
                // Ensure clean URL format (strip /rest/v1 or trailing slashes)
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

// Check if Supabase is active
function isSupabaseConfigured() {
    return supabaseClient !== null;
}

// Auto-initialize
initSupabase();
