<?php
$page_title = "Oferta sponsorska - SKR Argo AGH";
$page_description = "Argo to także wyjątkowa okazja dla podmiotów chcących promować swój wizerunek.";
$page_image = "https://argo.agh.edu.pl/storage/images/argologo.png";
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>SKR Argo AGH - Współpraca</title>
    <?php require_once('layout/header.php'); ?>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    /* ============================================
       PARTNERZY COPY – SCROLL ANIMATIONS
       ============================================ */

    /* Hero entrance */
    @keyframes fadeSlideUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .dolacz-hero .dolacz-hero-eyebrow {
      animation: fadeSlideUp 1s cubic-bezier(0.16,1,0.3,1) 0.25s both;
    }
    .dolacz-hero .dolacz-hero-title {
      animation: fadeSlideUp 1.1s cubic-bezier(0.16,1,0.3,1) 0.45s both;
    }

    /* Generic scroll reveal */
    .anim-reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.95s cubic-bezier(0.16,1,0.3,1),
                  transform 0.95s cubic-bezier(0.16,1,0.3,1);
    }
    .anim-reveal.is-visible {
      opacity: 1;
      transform: none;
    }

    /* Staggered children */
    .anim-stagger > * {
      opacity: 0;
      transform: translateY(36px);
      transition: opacity 0.75s cubic-bezier(0.16,1,0.3,1),
                  transform 0.75s cubic-bezier(0.16,1,0.3,1);
    }
    .anim-stagger.is-visible > *:nth-child(1) { transition-delay: 0.05s; }
    .anim-stagger.is-visible > *:nth-child(2) { transition-delay: 0.18s; }
    .anim-stagger.is-visible > *:nth-child(3) { transition-delay: 0.31s; }
    .anim-stagger.is-visible > *:nth-child(4) { transition-delay: 0.44s; }
    .anim-stagger.is-visible > * {
      opacity: 1;
      transform: none;
    }

    /* ============================================
       SAILING INTERLUDE
       ============================================ */
    .partnerzy-boat-section {
      height: 360vh;
      position: relative;
    }
    .partnerzy-boat-sticky {
      position: sticky;
      top: 0;
      height: 100vh;
      overflow: hidden;
      background: #020c17;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Sky gradient */
    .partnerzy-boat-sky {
      position: absolute;
      inset: 0;
      background: radial-gradient(ellipse 120% 80% at 50% 0%, #0a2645 0%, #020c17 65%);
    }

    /* Star field – static points via box-shadow */
    .partnerzy-boat-stars {
      position: absolute;
      inset: 0;
      pointer-events: none;
    }
    .partnerzy-boat-stars::before,
    .partnerzy-boat-stars::after {
      content: '';
      position: absolute;
      inset: 0;
    }
    .partnerzy-boat-stars::before {
      background:
        radial-gradient(1px 1px at 12% 8%,  rgba(255,255,255,0.85) 0%, transparent 100%),
        radial-gradient(1px 1px at 83% 5%,  rgba(255,255,255,0.6)  0%, transparent 100%),
        radial-gradient(1.5px 1.5px at 44% 12%, rgba(255,255,255,0.9) 0%, transparent 100%),
        radial-gradient(1px 1px at 65% 18%, rgba(255,255,255,0.5)  0%, transparent 100%),
        radial-gradient(1px 1px at 28% 22%, rgba(255,255,255,0.7)  0%, transparent 100%),
        radial-gradient(1px 1px at 91% 28%, rgba(255,255,255,0.4)  0%, transparent 100%),
        radial-gradient(1px 1px at 7%  35%, rgba(255,255,255,0.55) 0%, transparent 100%),
        radial-gradient(1.5px 1.5px at 56% 6%, rgba(255,255,255,0.8) 0%, transparent 100%),
        radial-gradient(1px 1px at 38% 30%, rgba(255,255,255,0.45) 0%, transparent 100%),
        radial-gradient(1px 1px at 74% 10%, rgba(255,255,255,0.65) 0%, transparent 100%),
        radial-gradient(1px 1px at 20% 14%, rgba(255,255,255,0.35) 0%, transparent 100%),
        radial-gradient(1px 1px at 96% 16%, rgba(255,255,255,0.5)  0%, transparent 100%);
      animation: twinkleA 4s ease-in-out infinite alternate;
    }
    .partnerzy-boat-stars::after {
      background:
        radial-gradient(1px 1px at 50% 3%,  rgba(255,255,255,0.9)  0%, transparent 100%),
        radial-gradient(1px 1px at 33% 17%, rgba(255,255,255,0.6)  0%, transparent 100%),
        radial-gradient(1.5px 1.5px at 78% 22%, rgba(255,255,255,0.75) 0%, transparent 100%),
        radial-gradient(1px 1px at 5%  20%, rgba(255,255,255,0.5)  0%, transparent 100%),
        radial-gradient(1px 1px at 88% 35%, rgba(255,255,255,0.45) 0%, transparent 100%),
        radial-gradient(1px 1px at 60% 28%, rgba(255,255,255,0.55) 0%, transparent 100%),
        radial-gradient(1px 1px at 16% 40%, rgba(255,255,255,0.4)  0%, transparent 100%),
        radial-gradient(1px 1px at 42% 25%, rgba(255,255,255,0.6)  0%, transparent 100%);
      animation: twinkleB 5.5s ease-in-out infinite alternate;
    }
    @keyframes twinkleA {
      from { opacity: 0.5; } to { opacity: 1; }
    }
    @keyframes twinkleB {
      from { opacity: 0.8; } to { opacity: 0.3; }
    }

    /* Moon */
    .partnerzy-boat-moon {
      position: absolute;
      top: 8%;
      right: 12%;
      width: 82px;
      height: 82px;
      border-radius: 50%;
      background: radial-gradient(circle at 40% 40%, #f0e8c8, #c8b878);
      box-shadow: 0 0 30px 8px rgba(240,220,140,0.2), 0 0 80px 20px rgba(240,220,140,0.08);
    }

    /* Ocean — covers bottom 36% of the scene */
    .partnerzy-boat-ocean {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 36%;
      background: linear-gradient(to bottom, #071f38 0%, #030e1d 100%);
    }

    /* Horizon shimmer — sits right at ocean top */
    .partnerzy-boat-horizon {
      position: absolute;
      bottom: 35%;
      left: 0;
      right: 0;
      height: 1px;
      background: linear-gradient(to right,
        transparent 0%,
        rgba(120,180,240,0.3) 30%,
        rgba(160,210,255,0.5) 50%,
        rgba(120,180,240,0.3) 70%,
        transparent 100%);
      box-shadow: 0 0 40px 12px rgba(100,160,220,0.12);
    }

    /* Moon reflection — thin vertical shimmer on the water */
    .partnerzy-boat-reflection {
      position: absolute;
      bottom: 3%;
      right: 14.5%;
      width: 8px;
      height: 30%;
      background: linear-gradient(to bottom, rgba(240,220,140,0.5) 0%, transparent 100%);
      filter: blur(3px);
      animation: reflectFlicker 3s ease-in-out infinite alternate;
    }
    @keyframes reflectFlicker {
      from { opacity: 0.6; transform: scaleX(1); }
      to   { opacity: 0.9; transform: scaleX(1.6); }
    }

    /* Waves container — fills the entire ocean */
    .partnerzy-waves {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 36%;
      overflow: hidden;
    }
    .partnerzy-wave-track {
      position: absolute;
      left: 0;
      width: 200%;
    }
    .partnerzy-wave-track svg { display: block; width: 100%; }

    /* 5 layers spread across ocean depth, slowest near horizon */
    .partnerzy-wave-1 { bottom: 68%; animation: waveScroll 22s linear infinite; }
    .partnerzy-wave-2 { bottom: 50%; animation: waveScroll 16s linear infinite reverse; }
    .partnerzy-wave-3 { bottom: 32%; animation: waveScroll 11s linear infinite; }
    .partnerzy-wave-4 { bottom: 14%; animation: waveScroll  8s linear infinite reverse; }
    .partnerzy-wave-5 { bottom:  0%; animation: waveScroll  6s linear infinite; }
    @keyframes waveScroll {
      from { transform: translateX(0); }
      to   { transform: translateX(-50%); }
    }

    /* The sailing boat SVG */
    .partnerzy-sail-boat {
      position: absolute;
      width: 12rem;
      bottom: calc(32% - 0.5rem);
      will-change: transform;
      filter: brightness(0) invert(1);
      opacity: 0.88;
      z-index: 10;
      transform: translateX(-250px);
    }

    /* Center text overlay */
    .partnerzy-boat-text {
      position: absolute;
      top: 28%;
      left: 50%;
      transform: translateX(-50%) translateY(-50%);
      text-align: center;
      pointer-events: none;
      white-space: nowrap;
      z-index: 5;
    }
    .partnerzy-boat-tagline {
      font-family: 'Cinzel', serif;
      font-size: clamp(1rem, 2.8vw, 2rem);
      color: rgba(255,255,255,0.88);
      letter-spacing: 0.18em;
      text-transform: uppercase;
      margin: 0;
      opacity: 0;
      transform: translateY(10px);
      transition: opacity 1s ease, transform 1s ease;
    }
    .partnerzy-boat-sub {
      font-family: 'Inter', sans-serif;
      font-size: 0.72rem;
      color: rgba(255,255,255,0.32);
      letter-spacing: 0.28em;
      text-transform: uppercase;
      margin-top: 1rem;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 0.9s ease 0.5s, transform 0.9s ease 0.5s;
    }
    .partnerzy-boat-tagline.show,
    .partnerzy-boat-sub.show {
      opacity: 1;
      transform: translateY(0);
    }

    /* ============================================
       CTA WORD REVEAL
       ============================================ */
    .cta-word {
      display: inline-block;
      opacity: 0;
      transform: translateY(22px);
      transition: opacity 0.65s cubic-bezier(0.16,1,0.3,1),
                  transform 0.65s cubic-bezier(0.16,1,0.3,1);
    }
    .cta-word.show {
      opacity: 1;
      transform: none;
    }

    /* End text — replaces tagline, fills the sky */
    .partnerzy-boat-text-end {
      white-space: normal;
      width: 85vw;
      max-width: 95vw;
      top: 32%;
    }
    .partnerzy-boat-end-eyebrow {
      font-family: 'Cinzel', serif;
      font-size: 1.8rem;
      letter-spacing: 0.32em;
      text-transform: uppercase;
      color: rgba(140,190,235,0.55);
      margin: 0 0 1.5rem;
      opacity: 0;
      transition: opacity 0.7s ease;
    }
    .partnerzy-boat-end-rule {
      width: 36px;
      height: 1px;
      background: rgba(255,255,255,0.2);
      margin: 0 auto 2rem;
      opacity: 0;
      transition: opacity 0.7s ease 0.2s, width 0.8s ease 0.2s;
    }
    .partnerzy-boat-endpara {
      font-family: 'Inter', sans-serif;
      font-size: clamp(0.95rem, 1.8vw, 1.3rem);
      font-weight: 310;
      line-height: 2;
      color: rgba(255,255,255,0.72);
      margin: 0;
      opacity: 0;
      transform: translateY(14px);
      transition: opacity 1s ease 0.35s, transform 1s ease 0.35s;
    }
    .partnerzy-boat-text-end.show .partnerzy-boat-end-eyebrow { opacity: 1; }
    .partnerzy-boat-text-end.show .partnerzy-boat-end-rule    { opacity: 1; width: 52px; }
    .partnerzy-boat-text-end.show .partnerzy-boat-endpara     { opacity: 1; transform: none; }

    /* Highlight number entrance */
    @keyframes numIn {
      from { opacity: 0; transform: scale(0.75) translateY(18px); }
      to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .partnerzy-highlight-number.anim-num {
      animation: numIn 0.55s cubic-bezier(0.16,1,0.3,1) both;
    }

    /* Navbar — transparent during sailing interlude */
    .navbar.partnerzy-nav-clear {
      background: transparent !important;
      box-shadow: none !important;
      transition: background 0.6s ease, box-shadow 0.6s ease;
    }
    .navbar.partnerzy-nav-clear .navbar-brand,
    .navbar.partnerzy-nav-clear .nav-link {
      color: rgba(255,255,255,0.82) !important;
    }
    .navbar.partnerzy-nav-clear .navbar-toggler {
      border-color: rgba(255,255,255,0.4) !important;
    }

    /* ============================================
       DARK PAGE THEME – full-page cinematic
       ============================================ */

    /* Lead section — dark, seamless from hero */
    .dolacz-lead-section {
      background: #020c17 !important;
    }
    .dolacz-lead-text {
      color: rgba(255,255,255,0.68) !important;
      font-size: 1.12rem;
    }

    /* Benefits — deep navy with glass cards */
    .partnerzy-benefits-section {
      background: #071525 !important;
    }
    .partnerzy-benefits-section .dolacz-section-title {
      color: rgba(255,255,255,0.9) !important;
      letter-spacing: 3px;
    }
    .partnerzy-benefit-card {
      background: rgba(255,255,255,0.04) !important;
      border: 1px solid rgba(255,255,255,0.08) !important;
      transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease !important;
    }
    .partnerzy-benefit-card:hover {
      background: rgba(255,255,255,0.09) !important;
      box-shadow: 0 14px 44px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.13) !important;
      transform: translateY(-6px) !important;
    }
    .partnerzy-benefits-section .dolacz-req-icon {
      background: rgba(90,150,215,0.14) !important;
      color: rgba(175,210,255,0.88) !important;
    }
    .partnerzy-benefit-heading {
      color: rgba(255,255,255,0.88) !important;
    }
    .partnerzy-benefit-text {
      color: rgba(255,255,255,0.5) !important;
    }

    /* Highlight bar — deeper, more dramatic */
    .partnerzy-highlights {
      background: #030e1e !important;
      border-top:    1px solid rgba(255,255,255,0.05);
      border-bottom: 1px solid rgba(255,255,255,0.05);
      padding: 4rem 0 !important;
    }
    .partnerzy-highlight-item {
      border-right-color: rgba(255,255,255,0.07) !important;
    }
    .partnerzy-highlight-number {
      font-size: 3rem !important;
    }
    .partnerzy-highlight-label {
      color: rgba(135,178,220,0.62) !important;
      letter-spacing: 3px;
    }

    /* Image strip — keep full saturation but add depth at edges */
    .dolacz-images-strip {
      position: relative;
    }
    .dolacz-images-strip::before,
    .dolacz-images-strip::after {
      content: '';
      position: absolute;
      top: 0;
      bottom: 0;
      width: 60px;
      z-index: 2;
      pointer-events: none;
    }
    .dolacz-images-strip::before {
      left: 0;
      background: linear-gradient(to right, #030e1e, transparent);
    }
    .dolacz-images-strip::after {
      right: 0;
      background: linear-gradient(to left, #0d2240, transparent);
    }

    /* ============================================
       MOBILE  (≤ 767px)
       ============================================ */
    @media (max-width: 767px) {

      /* Shorter scroll tunnel on mobile */
      .partnerzy-boat-section { height: 240vh; }

      /* Allow tagline to wrap instead of overflowing */
      .partnerzy-boat-text {
        white-space: normal;
        width: 88vw;
      }
      .partnerzy-boat-tagline {
        font-size: 0.82rem;
        letter-spacing: 0.1em;
      }
      .partnerzy-boat-sub {
        font-size: 0.62rem;
        letter-spacing: 0.18em;
      }

      /* Smaller moon, adjusted position */
      .partnerzy-boat-moon {
        width: 48px;
        height: 48px;
        top: 5%;
        right: 6%;
      }
      .partnerzy-boat-reflection { right: 8%; }

      /* Smaller boat */
      .partnerzy-sail-boat { width: 7rem; }

      /* End text — full width, pushed below navbar */
      .partnerzy-boat-text-end {
        width: 92vw;
        max-width: 92vw;
        top: 40%;
      }
      .partnerzy-boat-end-eyebrow {
        font-size: 0.58rem;
        letter-spacing: 0.22em;
      }
      .partnerzy-boat-endpara {
        font-size: 0.9rem;
        line-height: 1.8;
      }

      /* Benefits cards — more breathing room */
      .partnerzy-benefits-section { padding: 3rem 0 3.5rem; }
      .partnerzy-benefit-card     { padding: 1.5rem 1.25rem; }

      /* Highlight bar numbers */
      .partnerzy-highlights { padding: 2.5rem 0 !important; }

      /* CTA */
      .partnerzy-cta-final  { padding: 5rem 1.5rem 6rem; }
    }
    </style>
</head>

<body>

    <div class="page-container">
        <div class="content-wrap">
            <?php require_once('layout/navbar.php'); ?>

            <!-- Hero -->
            <div class="dolacz-hero partnerzy-hero">
                <div class="dolacz-hero-inner">
                    <p class="dolacz-hero-eyebrow">SKR Argo AGH</p>
                    <h1 class="dolacz-hero-title">Współpraca</h1>
                </div>
            </div>

            <!-- ========= SAILING INTERLUDE ========= -->
            <div class="partnerzy-boat-section" id="boatSection">
                <div class="partnerzy-boat-sticky">

                    <div class="partnerzy-boat-sky"></div>
                    <div class="partnerzy-boat-stars"></div>
                    <div class="partnerzy-boat-moon"></div>
                    <div class="partnerzy-boat-ocean"></div>
                    <div class="partnerzy-boat-horizon"></div>
                    <div class="partnerzy-boat-reflection"></div>

                    <div class="partnerzy-boat-text">
                        <p class="partnerzy-boat-tagline" id="boatTagline">Płyniemy tam, gdzie liczą się marki.</p>
                        <p class="partnerzy-boat-sub"     id="boatSub">SKR Argo AGH &nbsp;·&nbsp; Akademickie Żeglarstwo Regatowe</p>
                    </div>

                    <div class="partnerzy-boat-text partnerzy-boat-text-end" id="boatEndBlock">
                        <p class="partnerzy-boat-end-eyebrow">Współpraca</p>
                        <div class="partnerzy-boat-end-rule"></div>
                        <p class="partnerzy-boat-endpara">
                            Argo to także wyjątkowa okazja dla podmiotów chcących promować swój wizerunek. W przeciwieństwie do innych kół studenckich oferujemy ekspozycję państwa organizacji podczas różnorodnych zawodów akademickich,
                            odbywających się na poziomie ogólnokrajowym. Świat żeglarstwa regatowego skupia wokół siebie wielu wpływowych ludzi i wiele ważnych organizacji, a to w połączeniu z naszym wyjątkowym motywem przewodnim, legitymacją AGH oraz częstymi sukcesami na podium, zapewni możliwość zaprezentowania Państwa wizerunku, unikatowym i niszowym klientom.
                        </p>
                    </div>

                    <img src="storage/images/sail_argo.svg" class="partnerzy-sail-boat" id="sailBoat" alt="">

                    <div class="partnerzy-waves">
                        <!-- wave 1: near horizon — gentle, faint -->
                        <div class="partnerzy-wave-track partnerzy-wave-1">
                            <svg viewBox="0 0 2880 55" preserveAspectRatio="none" height="55">
                                <path d="M0,34 C360,18 720,50 1080,34 C1440,18 1800,50 2160,34 C2520,18 2700,46 2880,34 L2880,55 L0,55 Z"
                                      fill="rgba(10,50,95,0.25)"/>
                            </svg>
                        </div>
                        <!-- wave 2: upper-mid -->
                        <div class="partnerzy-wave-track partnerzy-wave-2">
                            <svg viewBox="0 0 2880 75" preserveAspectRatio="none" height="75">
                                <path d="M0,42 C240,16 480,68 720,42 C960,16 1200,68 1440,42 C1680,16 1920,68 2160,42 C2400,16 2640,68 2880,42 L2880,75 L0,75 Z"
                                      fill="rgba(8,38,78,0.4)"/>
                            </svg>
                        </div>
                        <!-- wave 3: mid ocean -->
                        <div class="partnerzy-wave-track partnerzy-wave-3">
                            <svg viewBox="0 0 2880 105" preserveAspectRatio="none" height="105">
                                <path d="M0,48 C360,12 720,84 1080,48 C1440,12 1800,84 2160,48 C2520,12 2700,78 2880,48 L2880,105 L0,105 Z"
                                      fill="rgba(6,26,58,0.6)"/>
                            </svg>
                        </div>
                        <!-- wave 4: lower ocean — large, bold -->
                        <div class="partnerzy-wave-track partnerzy-wave-4">
                            <svg viewBox="0 0 2880 135" preserveAspectRatio="none" height="135">
                                <path d="M0,58 C180,18 360,88 540,58 C720,28 900,82 1080,58 C1260,28 1440,82 1620,58 C1800,28 1980,82 2160,58 C2340,28 2520,82 2700,58 C2790,42 2850,68 2880,58 L2880,135 L0,135 Z"
                                      fill="rgba(4,18,42,0.78)"/>
                            </svg>
                        </div>
                        <!-- wave 5: foreground — near-solid dark -->
                        <div class="partnerzy-wave-track partnerzy-wave-5">
                            <svg viewBox="0 0 2880 160" preserveAspectRatio="none" height="160">
                                <path d="M0,62 C200,22 400,92 600,58 C800,24 1000,86 1200,58 C1400,26 1600,86 1800,58 C2000,26 2200,86 2400,58 C2600,26 2780,82 2880,62 L2880,160 L0,160 Z"
                                      fill="rgba(3,12,26,0.96)"/>
                            </svg>
                        </div>
                    </div>

                </div>
            </div>
            <!-- ========= END SAILING INTERLUDE ========= -->

            <!-- Why Argo — benefit cards -->
            <section class="partnerzy-benefits-section anim-reveal">
                <div class="container">
                    <div class="dolacz-section-header">
                        <h2 class="dolacz-section-title">Dlaczego Argo?</h2>
                    </div>
                    <div class="row g-4 justify-content-center anim-stagger">
                        <div class="col-sm-6 col-lg-3">
                            <div class="partnerzy-benefit-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-flag"></i></div>
                                <h3 class="partnerzy-benefit-heading">Ekspozycja ogólnopolska</h3>
                                <p class="partnerzy-benefit-text">Zawody na poziomie ogólnokrajowym — Państwa logo dociera tam, gdzie liczą się decydenci.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="partnerzy-benefit-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                                <h3 class="partnerzy-benefit-heading">Prestiż AGH</h3>
                                <p class="partnerzy-benefit-text">Marka jednej z czołowych uczelni technicznych w Polsce jako naturalne tło dla Państwa wizerunku.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="partnerzy-benefit-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-users"></i></div>
                                <h3 class="partnerzy-benefit-heading">Niszowy odbiorca</h3>
                                <p class="partnerzy-benefit-text">Środowisko żeglarskie skupia wpływowych ludzi i organizacje — wyjątkowe grono, trudno osiągalne innymi kanałami.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="partnerzy-benefit-card">
                                <div class="dolacz-req-icon"><i class="fa-solid fa-trophy"></i></div>
                                <h3 class="partnerzy-benefit-heading">Sukcesy na podium</h3>
                                <p class="partnerzy-benefit-text">Regularne medale i wyróżnienia — Państwa marka widoczna w momencie, który wszyscy zapamiętują.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Highlight bar -->
            <section class="partnerzy-highlights anim-reveal" id="highlightsSection">
                <div class="container">
                    <div class="row justify-content-center text-center g-0">
                        <div class="col-4 partnerzy-highlight-item">
                            <span class="partnerzy-highlight-number" data-target="2" data-prefix="Top "> 2</span>
                            <span class="partnerzy-highlight-label">w uczelniach technicznych w Polsce </span>
                        </div>
                        <div class="col-4 partnerzy-highlight-item">
                            <span class="partnerzy-highlight-number" data-text="AGH">AGH</span>
                            <span class="partnerzy-highlight-label">legitymacja uczelni</span>
                        </div>
                        <div class="col-4 partnerzy-highlight-item">
                            <span class="partnerzy-highlight-number" data-target="2024" data-prefix="">2024</span>
                            <span class="partnerzy-highlight-label">rok założenia</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Images strip -->
            <div class="dolacz-images-strip anim-reveal">
                <div class="dolacz-strip-img" style="background-image: url('storage/images/2026/amp/podium_1.JPG')"></div>
                <div class="dolacz-strip-img" style="background-image: url('storage/images/2026/amp/IMG_9755.JPG')"></div>
                <div class="dolacz-strip-img" style="background-image: url('storage/images/2026/amp/att.G5xWBDuB_vEV_TJqyz3n4Pgim3HJ3SBCdVWpl9LUhz4.JPG')"></div>
            </div>

            <!-- CTA -->
            <section class="partnerzy-cta-final" id="ctaSection">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <p class="partnerzy-cta-eyebrow">Współpraca</p>
                            <h2 class="partnerzy-cta-headline">
                                <span class="cta-word">Twoja</span> <span class="cta-word">marka.</span><br>
                                <span class="cta-word">Na</span> <span class="cta-word">podium.</span>
                            </h2>
                            <p class="partnerzy-cta-sub">Skontaktuj się z nami i omówmy wspólnie możliwości współpracy z SKR Argo AGH.</p>
                            <br>
                            <a href="kontakt.php" class="dolacz-btn-primary">Skontaktuj się z nami</a>
                            <br>
                            <a href="mailto:argo@agh.edu.pl" class="partnerzy-cta-email-link">argo@agh.edu.pl</a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <?php require_once('layout/footer.php'); ?>
    </div>

    <script>
    /* ============================================
       PARTNERZY COPY – ANIMATION ENGINE
       ============================================ */

    // 1. Scroll reveal (anim-reveal + anim-stagger)
    const revealObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('is-visible');
                revealObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.anim-reveal, .anim-stagger').forEach(el => revealObs.observe(el));


    // 2. Scroll-driven sailing boat
    const boatSection = document.getElementById('boatSection');
    const sailBoat    = document.getElementById('sailBoat');
    const navbar      = document.querySelector('.navbar');
    const boatTagline = document.getElementById('boatTagline');
    const boatSub     = document.getElementById('boatSub');
    const boatEndBlock = document.getElementById('boatEndBlock');
    let textVisible    = false;
    let endVisible     = false;

    function updateBoat() {
        if (!boatSection || !sailBoat) return;

        const rect       = boatSection.getBoundingClientRect();
        const sectionH   = boatSection.offsetHeight;
        const viewH      = window.innerHeight/2;
        const scrolled   = -rect.top;
        const range      = sectionH - viewH;
        const progress   = Math.max(0, Math.min(1, scrolled / range));

        // Horizontal travel: off-left → off-right
        const boatW  = sailBoat.offsetWidth;
        const startX = -boatW - 60;
        const endX   = window.innerWidth + 60;
        const x      = startX + progress * (endX - startX);

        // Organic bob + tilt
        const bob  = Math.sin(progress * Math.PI * 5) * 6;
        const tilt = Math.sin(progress * Math.PI * 3.5) * 2.8;

        sailBoat.style.transform = `translateX(${x}px) translateY(${bob}px) rotate(${tilt}deg)`;

        // Navbar: transparent while sticky section is active
        const inSticky = rect.top <= 0 && rect.bottom >= window.innerHeight;
        navbar.classList.toggle('partnerzy-nav-clear', inSticky);

        // Tagline: while boat is crossing (progress 0–0.4)
        const inMiddle = progress > 0 && progress < 0.3;
        if (inMiddle && !textVisible) {
            boatTagline.classList.add('show');
            boatSub.classList.add('show');
            textVisible = true;
        } else if (!inMiddle && textVisible) {
            boatTagline.classList.remove('show');
            boatSub.classList.remove('show');
            textVisible = false;
        }

        // End card: after boat has exited right
        const inEnd = progress > 0.4;
        if (inEnd && !endVisible) {
            boatEndBlock.classList.add('show');
            endVisible = true;
        } else if (!inEnd && endVisible) {
            boatEndBlock.classList.remove('show');
            endVisible = false;
        }
    }

    window.addEventListener('scroll', updateBoat, { passive: true });
    updateBoat();


    // 3. Highlight number count-up
    function countUp(el) {
        const target = parseInt(el.dataset.target, 10);
        const suffix = el.dataset.suffix || '';
        const prefix = el.dataset.prefix || '';
        if (isNaN(target)) {
            el.classList.add('anim-num');
            return;
        }
        el.classList.add('anim-num');
        const duration  = 1600;
        const startTime = performance.now();
        (function tick(now) {
            const t       = Math.min((now - startTime) / duration, 1);
            const eased   = 1 - Math.pow(1 - t, 3); // ease-out cubic
            el.textContent = prefix + Math.round(eased * target) + suffix;
            if (t < 1) requestAnimationFrame(tick);
        })(performance.now());
    }

    const counterObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.querySelectorAll('[data-target]').forEach(countUp);
                // Pulse non-numeric stat
                e.target.querySelectorAll('[data-text]').forEach(el => el.classList.add('anim-num'));
                counterObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.4 });

    const hlSection = document.getElementById('highlightsSection');
    if (hlSection) counterObs.observe(hlSection);


    // 4. CTA headline word-by-word reveal
    const ctaObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.querySelectorAll('.cta-word').forEach((w, i) => {
                    setTimeout(() => w.classList.add('show'), i * 190);
                });
                ctaObs.unobserve(e.target);
            }
        });
    }, { threshold: 0.35 });

    const ctaSection = document.getElementById('ctaSection');
    if (ctaSection) ctaObs.observe(ctaSection);
    </script>

</body>

</html>