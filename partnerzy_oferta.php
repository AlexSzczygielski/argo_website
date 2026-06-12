<?php
// Start session before any output — navbar.php's session_start() would
// otherwise fire after headers are sent and print a warning mid-page.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
       PARTNERZY – HERO
       ============================================ */
    @keyframes fadeSlideUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .partnerzy-hero {
      position: relative;
    }
    .partnerzy-hero .dolacz-hero-inner {
      position: relative;
      z-index: 1;
    }
    .partnerzy-hero .dolacz-hero-eyebrow {
      animation: fadeSlideUp 1s cubic-bezier(0.16,1,0.3,1) 0.25s both;
    }
    .partnerzy-hero .dolacz-hero-title {
      animation: fadeSlideUp 1.1s cubic-bezier(0.16,1,0.3,1) 0.45s both;
    }
    /* Seamless fade into the night scene below */
    .partnerzy-hero::after {
      content: '';
      position: absolute;
      left: 0; right: 0; bottom: 0;
      height: 30%;
      background: linear-gradient(to bottom, transparent, #020c17);
      pointer-events: none;
    }
    /* Scroll cue */
    .partnerzy-scroll-cue {
      position: absolute;
      bottom: 26px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 2;
      animation: fadeSlideUp 1s ease 1.4s both;
    }
    .partnerzy-scroll-cue span {
      display: block;
      width: 12px;
      height: 12px;
      border-right: 2px solid rgba(255,255,255,0.55);
      border-bottom: 2px solid rgba(255,255,255,0.55);
      transform: rotate(45deg);
      animation: cueBounce 2s ease-in-out infinite;
    }
    @keyframes cueBounce {
      0%, 100% { transform: rotate(45deg) translate(0,0); opacity: 0.55; }
      50%      { transform: rotate(45deg) translate(5px,5px); opacity: 1; }
    }

    /* ============================================
       GENERIC SCROLL REVEAL
       ============================================ */
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
    .anim-stagger.is-visible > *:nth-child(5) { transition-delay: 0.57s; }
    .anim-stagger.is-visible > * {
      opacity: 1;
      transform: none;
    }

    /* ============================================
       SAILING INTERLUDE
       ============================================ */
    .partnerzy-boat-section {
      height: 280vh;
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

    /* Shooting stars */
    .partnerzy-shooting-star {
      position: absolute;
      width: 90px;
      height: 1.5px;
      background: linear-gradient(to left, rgba(255,255,255,0.9), transparent);
      border-radius: 2px;
      opacity: 0;
      pointer-events: none;
    }
    .partnerzy-shooting-star.star-a {
      top: 10%;
      left: 68%;
      animation: shootA 9s ease-out 3s infinite;
    }
    .partnerzy-shooting-star.star-b {
      top: 18%;
      left: 22%;
      width: 70px;
      animation: shootB 13s ease-out 7.5s infinite;
    }
    @keyframes shootA {
      0%   { opacity: 0; transform: translate(0,0) rotate(-28deg); }
      2%   { opacity: 0.9; }
      9%   { opacity: 0; transform: translate(-230px,120px) rotate(-28deg); }
      100% { opacity: 0; transform: translate(-230px,120px) rotate(-28deg); }
    }
    @keyframes shootB {
      0%   { opacity: 0; transform: translate(0,0) rotate(-18deg); }
      2%   { opacity: 0.7; }
      8%   { opacity: 0; transform: translate(-180px,60px) rotate(-18deg); }
      100% { opacity: 0; transform: translate(-180px,60px) rotate(-18deg); }
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
      will-change: transform;
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
      will-change: transform;
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
      left: 0;
      will-change: transform;
      filter: brightness(0) invert(1);
      opacity: 0.88;
      z-index: 10;
      transform: translateX(-250px);
    }

    /* Boat reflection — mirrored, blurred, fading */
    .partnerzy-sail-boat-reflection {
      position: absolute;
      width: 12rem;
      top: calc(68% + 0.4rem);
      left: 0;
      will-change: transform;
      filter: brightness(0) invert(1) blur(2px);
      opacity: 0.1;
      z-index: 9;
      transform: translateX(-250px) scaleY(-1);
      -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,0.9) 55%, transparent 100%);
              mask-image: linear-gradient(to top, rgba(0,0,0,0.9) 55%, transparent 100%);
      pointer-events: none;
    }

    /* Wake trail behind the boat */
    .partnerzy-boat-wake {
      position: absolute;
      bottom: calc(32% - 0.35rem);
      left: 0;
      width: 170px;
      height: 3px;
      background: linear-gradient(to right, rgba(220,240,255,0.55), rgba(180,215,250,0.18) 55%, transparent);
      border-radius: 3px;
      filter: blur(1px);
      will-change: transform;
      opacity: 0;
      z-index: 8;
      pointer-events: none;
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
    }
    /* Word-by-word reveal */
    .partnerzy-boat-tagline .tag-word {
      display: inline-block;
      opacity: 0;
      transform: translateY(16px);
      filter: blur(4px);
      transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1),
                  transform 0.8s cubic-bezier(0.16,1,0.3,1),
                  filter 0.8s cubic-bezier(0.16,1,0.3,1);
    }
    .partnerzy-boat-tagline.show .tag-word {
      opacity: 1;
      transform: none;
      filter: blur(0);
    }
    .partnerzy-boat-tagline.show .tag-word:nth-child(1) { transition-delay: 0.10s; }
    .partnerzy-boat-tagline.show .tag-word:nth-child(2) { transition-delay: 0.28s; }
    .partnerzy-boat-tagline.show .tag-word:nth-child(3) { transition-delay: 0.62s; }
    .partnerzy-boat-tagline.show .tag-word:nth-child(4) { transition-delay: 0.80s; }
    .partnerzy-boat-tagline.show .tag-word:nth-child(5) { transition-delay: 0.98s; }
    .partnerzy-boat-sub {
      font-family: 'Inter', sans-serif;
      font-size: 0.72rem;
      color: rgba(255,255,255,0.32);
      letter-spacing: 0.28em;
      text-transform: uppercase;
      margin-top: 1rem;
      opacity: 0;
      transform: translateY(8px);
      transition: opacity 0.9s ease 1.2s, transform 0.9s ease 1.2s;
    }
    .partnerzy-boat-sub.show {
      opacity: 1;
      transform: translateY(0);
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

    /* Benefits — deep navy with glass cards */
    .partnerzy-benefits-section {
      background: #071525 !important;
      padding-top: 5rem;
      padding-bottom: 5rem;
    }
    .partnerzy-benefits-section .dolacz-section-title {
      color: rgba(255,255,255,0.9) !important;
      letter-spacing: 3px;
    }
    .partnerzy-benefit-card {
      position: relative;
      overflow: hidden;
      background: rgba(255,255,255,0.04) !important;
      border: 1px solid rgba(255,255,255,0.08) !important;
      transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease !important;
    }
    /* Accent line that grows on hover */
    .partnerzy-benefit-card::after {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: linear-gradient(to right, transparent, rgba(150,200,255,0.7), transparent);
      transition: width 0.45s cubic-bezier(0.16,1,0.3,1), left 0.45s cubic-bezier(0.16,1,0.3,1);
    }
    .partnerzy-benefit-card:hover::after {
      width: 100%;
      left: 0;
    }
    .partnerzy-benefit-card:hover {
      background: rgba(255,255,255,0.09) !important;
      box-shadow: 0 14px 44px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.13) !important;
      transform: translateY(-6px) !important;
    }
    .partnerzy-benefits-section .dolacz-req-icon {
      background: rgba(90,150,215,0.14) !important;
      color: rgba(175,210,255,0.88) !important;
      box-shadow: 0 0 24px rgba(90,150,215,0.18);
      transition: box-shadow 0.3s ease, transform 0.3s ease;
    }
    .partnerzy-benefit-card:hover .dolacz-req-icon {
      box-shadow: 0 0 34px rgba(110,170,235,0.4);
      transform: scale(1.07);
    }
    .partnerzy-benefit-heading {
      color: rgba(255,255,255,0.88) !important;
    }
    .partnerzy-benefit-text {
      color: rgba(255,255,255,0.5) !important;
    }

    /* ============================================
       EXPOSURE / "CO ZYSKUJE PARTNER" SECTION
       ============================================ */
    .partnerzy-expo-section {
      background: #050f1d;
      padding: 5.5rem 0 6rem;
    }
    .partnerzy-expo-section .dolacz-section-title {
      color: rgba(255,255,255,0.9);
      letter-spacing: 3px;
    }
    .partnerzy-expo-eyebrow {
      font-family: 'Inter', sans-serif;
      font-size: 0.72rem;
      letter-spacing: 5px;
      text-transform: uppercase;
      color: rgba(120,165,210,0.6);
      text-align: center;
      margin-bottom: 0.9rem;
    }
    .partnerzy-expo-row {
      display: flex;
      align-items: baseline;
      gap: 2.2rem;
      padding: 1.9rem 1rem;
      border-top: 1px solid rgba(255,255,255,0.08);
      transition: background 0.35s ease, padding-left 0.35s ease;
    }
    .partnerzy-expo-row:last-of-type {
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .partnerzy-expo-row:hover {
      background: rgba(255,255,255,0.03);
      padding-left: 1.8rem;
    }
    .partnerzy-expo-num {
      font-family: 'Cinzel', serif;
      font-size: 2.2rem;
      font-weight: 600;
      color: rgba(110,165,225,0.32);
      min-width: 3.4rem;
      transition: color 0.35s ease;
    }
    .partnerzy-expo-row:hover .partnerzy-expo-num {
      color: rgba(160,205,255,0.75);
    }
    .partnerzy-expo-heading {
      font-family: 'Cinzel', serif;
      font-size: 1.05rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.86);
      margin: 0 0 0.45rem;
    }
    .partnerzy-expo-text {
      font-family: 'Inter', sans-serif;
      font-size: 0.92rem;
      line-height: 1.75;
      color: rgba(255,255,255,0.48);
      margin: 0;
      max-width: 640px;
    }
    .partnerzy-expo-note {
      font-family: 'Inter', sans-serif;
      font-size: 0.82rem;
      letter-spacing: 0.06em;
      color: rgba(140,180,220,0.55);
      text-align: center;
      margin: 2.6rem 0 0;
      font-style: italic;
    }

    /* ============================================
       HIGHLIGHT BAR
       ============================================ */
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
    .partnerzy-highlight-footnote {
      font-family: 'Inter', sans-serif;
      font-size: 0.72rem;
      letter-spacing: 0.08em;
      color: rgba(120,160,200,0.45);
      text-align: center;
      margin: 2.4rem auto 0;
      max-width: 560px;
    }
    .partnerzy-highlight-footnote sup {
      font-size: 0.7em;
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
       CTA POLISH
       ============================================ */
    .partnerzy-cta-final::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 70vw;
      height: 70vw;
      max-width: 900px;
      max-height: 900px;
      transform: translate(-50%, -50%);
      background: radial-gradient(circle, rgba(70,125,190,0.14) 0%, transparent 60%);
      animation: ctaGlow 7s ease-in-out infinite alternate;
      pointer-events: none;
    }
    @keyframes ctaGlow {
      from { opacity: 0.55; transform: translate(-50%, -50%) scale(0.92); }
      to   { opacity: 1;    transform: translate(-50%, -50%) scale(1.06); }
    }
    .partnerzy-cta-final .container { z-index: 1; }

    /* Button shine sweep */
    .partnerzy-cta-final .dolacz-btn-primary {
      position: relative;
      overflow: hidden;
    }
    .partnerzy-cta-final .dolacz-btn-primary::after {
      content: '';
      position: absolute;
      top: 0;
      left: -80%;
      width: 50%;
      height: 100%;
      background: linear-gradient(105deg, transparent, rgba(30,63,102,0.14), transparent);
      transform: skewX(-20deg);
      transition: left 0.6s ease;
    }
    .partnerzy-cta-final .dolacz-btn-primary:hover::after {
      left: 130%;
    }

    /* ============================================
       REDUCED MOTION
       ============================================ */
    @media (prefers-reduced-motion: reduce) {
      .anim-reveal, .anim-stagger > *,
      .partnerzy-boat-tagline .tag-word, .partnerzy-boat-sub,
      .partnerzy-boat-end-eyebrow, .partnerzy-boat-end-rule, .partnerzy-boat-endpara,
      .cta-word {
        opacity: 1 !important;
        transform: none !important;
        filter: none !important;
        transition: none !important;
      }
      .partnerzy-boat-stars::before, .partnerzy-boat-stars::after,
      .partnerzy-shooting-star, .partnerzy-boat-reflection,
      .partnerzy-wave-track, .partnerzy-scroll-cue span,
      .partnerzy-cta-final::after,
      .partnerzy-hero .dolacz-hero-eyebrow, .partnerzy-hero .dolacz-hero-title {
        animation: none !important;
      }
      .partnerzy-boat-section { height: 100vh; }
      .partnerzy-sail-boat {
        transform: translateX(calc(50vw - 6rem)) !important;
      }
      .partnerzy-sail-boat-reflection, .partnerzy-boat-wake { display: none; }
      .partnerzy-boat-text { display: none; }
      .partnerzy-boat-text.partnerzy-boat-text-end { display: block; }
    }

    /* ============================================
       MOBILE  (≤ 767px)
       ============================================ */
    @media (max-width: 767px) {

      /* Shorter scroll tunnel on mobile */
      .partnerzy-boat-section { height: 200vh; }

      /* Allow tagline to wrap instead of overflowing */
      .partnerzy-boat-text {
        white-space: normal;
        width: 88vw;
      }
      .partnerzy-boat-tagline {
        font-size: 0.95rem;
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
      .partnerzy-sail-boat            { width: 7rem; }
      .partnerzy-sail-boat-reflection { width: 7rem; }
      .partnerzy-boat-wake            { width: 110px; }

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

      /* Exposure rows */
      .partnerzy-expo-section { padding: 3.5rem 0 4rem; }
      .partnerzy-expo-row {
        gap: 1.1rem;
        padding: 1.4rem 0.25rem;
      }
      .partnerzy-expo-row:hover { padding-left: 0.6rem; }
      .partnerzy-expo-num     { font-size: 1.5rem; min-width: 2.3rem; }
      .partnerzy-expo-heading { font-size: 0.9rem; }
      .partnerzy-expo-text    { font-size: 0.86rem; }

      /* Highlight bar numbers */
      .partnerzy-highlights { padding: 2.5rem 0 !important; }
      .partnerzy-highlight-footnote {
        font-size: 0.62rem;
        margin-top: 1.6rem;
        padding: 0 1rem;
      }

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
                <div class="partnerzy-scroll-cue"><span></span></div>
            </div>

            <!-- ========= SAILING INTERLUDE ========= -->
            <div class="partnerzy-boat-section" id="boatSection">
                <div class="partnerzy-boat-sticky">

                    <div class="partnerzy-boat-sky"></div>
                    <div class="partnerzy-boat-stars"></div>
                    <div class="partnerzy-shooting-star star-a"></div>
                    <div class="partnerzy-shooting-star star-b"></div>
                    <div class="partnerzy-boat-moon" id="boatMoon"></div>
                    <div class="partnerzy-boat-ocean"></div>
                    <div class="partnerzy-boat-horizon"></div>
                    <div class="partnerzy-boat-reflection"></div>

                    <div class="partnerzy-boat-text">
                        <p class="partnerzy-boat-tagline" id="boatTagline"><span class="tag-word">Twoja</span> <span class="tag-word">marka.</span> <span class="tag-word">Pod</span> <span class="tag-word">pełnymi</span> <span class="tag-word">żaglami.</span></p>
                        <p class="partnerzy-boat-sub"     id="boatSub">SKR Argo AGH &nbsp;·&nbsp; Akademickie Żeglarstwo Regatowe</p>
                    </div>

                    <div class="partnerzy-boat-text partnerzy-boat-text-end" id="boatEndBlock">
                        <p class="partnerzy-boat-end-eyebrow">Współpraca</p>
                        <div class="partnerzy-boat-end-rule"></div>
                        <p class="partnerzy-boat-endpara">
                            Argo to wyjątkowa okazja dla podmiotów chcących budować swój wizerunek. W przeciwieństwie do innych kół studenckich oferujemy ekspozycję Państwa organizacji podczas zawodów akademickich rangi ogólnopolskiej.
                            Świat żeglarstwa regatowego skupia wokół siebie wpływowych ludzi i znaczące organizacje — a to, w połączeniu z naszym wyjątkowym motywem przewodnim, marką AGH oraz regularnymi sukcesami na podium, daje możliwość zaprezentowania Państwa wizerunku unikatowemu, niszowemu gronu odbiorców.
                        </p>
                    </div>

                    <img src="storage/images/sail_argo.svg" class="partnerzy-sail-boat" id="sailBoat" alt="">
                    <img src="storage/images/sail_argo.svg" class="partnerzy-sail-boat-reflection" id="sailBoatReflection" alt="" aria-hidden="true">
                    <div class="partnerzy-boat-wake" id="boatWake"></div>

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

            <!-- What the partner gets — exposure placements -->
            <section class="partnerzy-expo-section anim-reveal">
                <div class="container">
                    <div class="dolacz-section-header">
                        <p class="partnerzy-expo-eyebrow">Formy ekspozycji</p>
                        <h2 class="dolacz-section-title">Co zyskuje Partner?</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-9 anim-stagger">
                            <div class="partnerzy-expo-row">
                                <span class="partnerzy-expo-num">01</span>
                                <div>
                                    <h3 class="partnerzy-expo-heading">Żagiel i kadłub</h3>
                                    <p class="partnerzy-expo-text">Logo Państwa marki na łodzi regatowej — w centrum kadru każdego zdjęcia, ceremonii medalowej i relacji z zawodów.</p>
                                </div>
                            </div>
                            <div class="partnerzy-expo-row">
                                <span class="partnerzy-expo-num">02</span>
                                <div>
                                    <h3 class="partnerzy-expo-heading">Odzież załogi</h3>
                                    <p class="partnerzy-expo-text">Ekspozycja na koszulkach i odzieży regatowej członków koła — podczas zawodów ogólnopolskich oraz wydarzeń na AGH.</p>
                                </div>
                            </div>
                            <div class="partnerzy-expo-row">
                                <span class="partnerzy-expo-num">03</span>
                                <div>
                                    <h3 class="partnerzy-expo-heading">Media i relacje</h3>
                                    <p class="partnerzy-expo-text">Obecność w naszych mediach społecznościowych — relacjach z regat, postach wynikowych i materiałach wideo.</p>
                                </div>
                            </div>
                            <div class="partnerzy-expo-row">
                                <span class="partnerzy-expo-num">04</span>
                                <div>
                                    <h3 class="partnerzy-expo-heading">Wydarzenia i materiały</h3>
                                    <p class="partnerzy-expo-text">Logo w materiałach promocyjnych koła oraz podczas wydarzeń akademickich z udziałem społeczności AGH.</p>
                                </div>
                            </div>
                            <p class="partnerzy-expo-note">Zakres współpracy dopasowujemy indywidualnie do potrzeb Partnera.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Highlight bar -->
            <section class="partnerzy-highlights anim-reveal" id="highlightsSection">
                <div class="container">
                    <div class="row justify-content-center text-center g-0">
                        <div class="col-4 partnerzy-highlight-item">
                            <span class="partnerzy-highlight-number" data-target="2" data-prefix="Top ">Top 2</span>
                            <span class="partnerzy-highlight-label">wśród uczelni technicznych<sup>*</sup></span>
                        </div>
                        <div class="col-4 partnerzy-highlight-item">
                            <span class="partnerzy-highlight-number" data-text="AGH">AGH</span>
                            <span class="partnerzy-highlight-label">legitymacja uczelni</span>
                        </div>
                        <div class="col-4 partnerzy-highlight-item">
                            <span class="partnerzy-highlight-number" data-text="2024">2024</span>
                            <span class="partnerzy-highlight-label">rok założenia</span>
                        </div>
                    </div>
                    <p class="partnerzy-highlight-footnote"><sup>*</sup>Akademickie Mistrzostwa Polski w Żeglarstwie 2026 — 2. miejsce w klasyfikacji uczelni technicznych, 5. w klasyfikacji generalnej</p>
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
       PARTNERZY – ANIMATION ENGINE
       ============================================ */
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

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


    // 2. Scroll-driven sailing boat (rAF-throttled)
    const boatSection  = document.getElementById('boatSection');
    const sailBoat     = document.getElementById('sailBoat');
    const sailRefl     = document.getElementById('sailBoatReflection');
    const boatWake     = document.getElementById('boatWake');
    const boatMoon     = document.getElementById('boatMoon');
    const navbar       = document.querySelector('.navbar');
    const boatTagline  = document.getElementById('boatTagline');
    const boatSub      = document.getElementById('boatSub');
    const boatEndBlock = document.getElementById('boatEndBlock');
    let textVisible    = false;
    let endVisible     = false;

    function updateBoat() {
        if (!boatSection || !sailBoat) return;

        const rect     = boatSection.getBoundingClientRect();
        const range    = boatSection.offsetHeight - window.innerHeight;
        const progress = Math.max(0, Math.min(1, -rect.top / range));

        // Boat completes its crossing during the first 62% of the scroll,
        // leaving the rest of the tunnel for the closing text.
        const boatP = Math.min(1, progress / 0.62);

        // Right → left, matching the sail direction in the logo
        const boatW  = sailBoat.offsetWidth;
        const startX = window.innerWidth + 60;
        const endX   = -boatW - 60;
        const x      = startX + boatP * (endX - startX);

        // Organic bob + tilt
        const bob  = Math.sin(boatP * Math.PI * 5) * 6;
        const tilt = Math.sin(boatP * Math.PI * 3.5) * 2.8;

        sailBoat.style.transform = `translateX(${x}px) translateY(${bob}px) rotate(${tilt}deg)`;
        if (sailRefl) {
            sailRefl.style.transform = `translateX(${x}px) translateY(${-bob * 0.6}px) rotate(${-tilt}deg) scaleY(-1)`;
        }
        if (boatWake) {
            boatWake.style.transform = `translateX(${x + boatW - 20}px)`;
            boatWake.style.opacity = (boatP > 0.01 && boatP < 0.99) ? 0.8 : 0;
        }
        if (boatMoon) {
            boatMoon.style.transform = `translateY(${progress * 26}px)`;
        }

        // Navbar: transparent while sticky section is active
        const inSticky = rect.top <= 0 && rect.bottom >= window.innerHeight;
        navbar.classList.toggle('partnerzy-nav-clear', inSticky);

        // Tagline: while boat is crossing
        const inMiddle = progress > 0.02 && progress < 0.42;
        if (inMiddle !== textVisible) {
            boatTagline.classList.toggle('show', inMiddle);
            boatSub.classList.toggle('show', inMiddle);
            textVisible = inMiddle;
        }

        // End card: after the boat has sailed off
        const inEnd = progress > 0.55;
        if (inEnd !== endVisible) {
            boatEndBlock.classList.toggle('show', inEnd);
            endVisible = inEnd;
        }
    }

    if (reducedMotion) {
        // Static scene: boat centred, closing text always visible
        if (boatEndBlock) boatEndBlock.classList.add('show');
    } else {
        let ticking = false;
        function onScroll() {
            if (!ticking) {
                requestAnimationFrame(() => { updateBoat(); ticking = false; });
                ticking = true;
            }
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', onScroll, { passive: true });
        updateBoat();
    }


    // 3. Highlight number count-up
    function countUp(el) {
        const target = parseInt(el.dataset.target, 10);
        const suffix = el.dataset.suffix || '';
        const prefix = el.dataset.prefix || '';
        el.classList.add('anim-num');
        if (isNaN(target) || reducedMotion) return;
        const duration  = 1400;
        const startTime = performance.now();
        (function tick(now) {
            const t     = Math.min((now - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - t, 3); // ease-out cubic
            el.textContent = prefix + Math.round(eased * target) + suffix;
            if (t < 1) requestAnimationFrame(tick);
        })(performance.now());
    }

    const counterObs = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.querySelectorAll('[data-target]').forEach(countUp);
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
