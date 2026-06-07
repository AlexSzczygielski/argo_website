/**
 * 
 * @returns {string} - Placeholder table - to show during results loading
 */
function loadPlaceholderTable(){
    const html = `
    <div class="argo-table-wrap">
        <table class="argo-table" id="argo-tbl-0">
            <thead>
            <tr>
                <th>#</th>
                <th>Nr żagla</th>
                <th>Załoga</th>
                <th>Klub</th>
            </tr>
            </thead>
            <tbody>
            <tr class="loading-row"><td colspan="4">Ładowanie wyników…</td></tr>
            </tbody>
        </table>
    </div>
    `;
    return html
}

/**
 * Extracts the regatta slug from a public Upwind24 URL.
 * Handles both /regatta/slug and direct slug formats.
 *
 * @param {string} url - Public regatta URL
 * @returns {string} Regatta slug
 */
function extractSlug(url) {
    url = url.replace(/\/$/, ''); // strip trailing slash
    if (url.includes('/regatta/')) {
        return url.split('/regatta/').pop();
    }
    // fallback: take last path segment, strip /results if present
    return url.split('/').pop().replace('/results', '');
}

/**
 * Fetches leaderboard json for a regatta from the Upwind24 API.
 *
 * @param {string} regattaUrl - Public Upwind24 regatta URL
 * @returns {Promise<{leaderboards_json: Array, slug: string}>}
 */
async function loadLeaderboardJson(regattaUrl) {
    const slug = extractSlug(regattaUrl);
    const response = await fetch(`https://api.upwind24.pl/v1/regattas/${slug}/leaderboards`);
    const data = await response.json();
    const leaderboards_json = data.data;
    return {leaderboards_json, slug};
}

/**
 * Fetches full results in json for all leaderboards of a regatta.
 *
 * @param {string} regattaUrl - Public Upwind24 regatta URL
 * @returns {Promise<Array<{name: string, data: Array}>>}
 */
async function getResultsJson(regattaUrl) {
    const {leaderboards_json, slug} = await loadLeaderboardJson(regattaUrl);
    const base_url = `https://api.upwind24.pl/v1/regattas/${slug}/leaderboards`;

    const leaderboards_url = [];
    leaderboards_json.forEach(element => {
        leaderboards_url.push({
            name: element.name,
            url: `${base_url}/${element.id}`
        });
    });

    const results = [];
    for (const lb of leaderboards_url) {
        const response = await fetch(lb.url);
        const data = await response.json();
        results.push({
            name: lb.name,
            data: data.data.results
        });
    }

    return results;
}

/**
 * Filters results for AGH entries and renders leaderboard tables into the container.
 *
 * @param {Array<{name: string, data: Array}>} results - Leaderboard results json from getResultsJson
 * @param {HTMLElement} container - DOM element to render into
 * @param {string} regattaUrl - Public regatta URL for the "full results" link
 */
function renderResults(results, container, regattaUrl) {
    
    container.innerHTML = "" //clear the placeholder table
    
    results.forEach(leaderboard => {
        //Filter results
        const agh_entries = leaderboard.data.filter(item => {
            const club = item.boat?.helmsman?.sailingClub?.fullName ?? '';
            return club.toLowerCase().includes('agh');
        });

        //Build HTML
        if (agh_entries.length === 0) return; //return if no agh found - prevents empty arrays from different classes
        let html = '';

        html += `<h3 class='mt-4'>${leaderboard.name}</h3>`;
        html += '<div class="argo-table-wrap">'
        html += `<table class="argo-table">`;
        html += `<thead><tr><th>Wynik</th><th>Nr żagla</th><th>Załoga</th><th>Klub</th></tr></thead>`;
        html += `<tbody>`;

        agh_entries.forEach(entry => {
            const crew = entry.boat.crew.map(c => `${c.firstName} ${c.lastName}`).join(', ');
            html += `<tr>
                <td>${entry.overallPlace}</td>
                <td>${entry.boat.sailNumber}</td>
                <td>${entry.boat.helmsman.firstName}  ${entry.boat.helmsman.lastName}, ${crew}</td>
                <td>${entry.boat.helmsman.sailingClub?.fullName ?? ''}</td>
            </tr>`;
        });

        html += `</tbody></table>`;
        html += '</div>';
        container.innerHTML += html;
    });
    
    container.innerHTML += `<a href="${regattaUrl}" target="_blank" class="btn btn-outline-secondary mt-3 d-inline-block">
                                Pełne wyniki na stronie Upwind24 ↗
                            </a>`;
}

/**
 * entrypoint from html
 */
const container = document.getElementById('upwind-results');
if(container) {
    container.innerHTML = loadPlaceholderTable();
    (async () => {
        try {
            const regattaUrl = container.dataset.regattaUrl;
            const results = await getResultsJson(regattaUrl);
            renderResults(results, container, regattaUrl);
        } catch (e) {
            container.innerHTML = `<p class="text-muted">Nie udało się załadować wyników.</p>`;
            console.error('Upwind API error:', e);
        }
    })();
}