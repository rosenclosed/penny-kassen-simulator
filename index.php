<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Penny-Kassen-Sim</title>
    <link rel="stylesheet" href="/res/style/main.min.css" />
    <script src="/res/script/jquery-3.7.1.min.js"></script>
    <link href="/res/script/register.js" rel="preload" as="script">
</head>

<body>
    <div class="main" id="main-div">
        <div class="register-screen" id="register-screen">
            <div class="screen-left-side">
                <div class="numpad-area">
                    <div class="numpad-op-btn-area">
                        <div class="numpad-back-btn">
                            <button id="numpad-back-btn" class="penny-btn btn-orange"></button>
                        </div>
                        <div class="numpad-delete-btn">
                            <button id="numpad-delete-btn" class="penny-btn btn-light-red">LÖSCHEN</button>
                        </div>
                        <div class="numpad-menge-btn">
                            <button id="numpad-menge-btn" class="penny-btn btn-green">MENGE</button>
                        </div>
                        <div class="numpad-eingabe-btn">
                            <button id="numpad-eingabe-btn" class="penny-btn btn-green disabled">EIN<br />GABE</button>
                        </div>
                    </div>
                    <div class="numpad-pad-area">
                        <div class="numpad-line">
                            <span id="numpad-number-line"></span>
                        </div>
                        <div class="numpad-pad-btn-area">
                            <div class="numpad-0-btn">
                                <button id="numpad-0-btn" class="penny-btn btn-dark-gray">0</button>
                            </div>
                            <div class="numpad-00-btn">
                                <button id="numpad-00-btn" class="penny-btn btn-dark-gray">00</button>
                            </div>
                            <div class="numpad-1-btn">
                                <button id="numpad-1-btn" class="penny-btn btn-dark-gray">1</button>
                            </div>
                            <div class="numpad-3-btn">
                                <button id="numpad-3-btn" class="penny-btn btn-dark-gray">3</button>
                            </div>
                            <div class="numpad-2-btn">
                                <button id="numpad-2-btn" class="penny-btn btn-dark-gray">2</button>
                            </div>
                            <div class="numpad-4-btn">
                                <button id="numpad-4-btn" class="penny-btn btn-dark-gray">4</button>
                            </div>
                            <div class="numpad-5-btn">
                                <button id="numpad-5-btn" class="penny-btn btn-dark-gray">5</button>
                            </div>
                            <div class="numpad-6-btn">
                                <button id="numpad-6-btn" class="penny-btn btn-dark-gray">6</button>
                            </div>
                            <div class="numpad-7-btn">
                                <button id="numpad-7-btn" class="penny-btn btn-dark-gray">7</button>
                            </div>
                            <div class="numpad-8-btn">
                                <button id="numpad-8-btn" class="penny-btn btn-dark-gray">8</button>
                            </div>
                            <div class="numpad-9-btn">
                                <button id="numpad-9-btn" class="penny-btn btn-dark-gray">9</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="digital-receipt-area">
                    <div class="digital-receipt-description-bar">
                        <div>
                            <span>Bezeichnung</span><span>EUR</span>
                        </div>
                    </div>
                    <div class="digital-receipt-list">
                        <!-- <div class="digital-receipt-list-item" id="digital-receipt-list-item01">
                            <span id="digital-receipt-list-item01-name"></span><span
                                id="digital-receipt-list-item01-price"></span>
                        </div> -->
                    </div>
                    <div class="digital-receipt-bottom-area">
                        <div class="digital-receipt-sum-area">
                            <span id="digital-receipt-sum"></span>
                        </div>
                        <div class="digital-receipt-btn-area">
                            <div class="digital-receipt-up-btn">
                                <button id="digital-receipt-up-btn" class="penny-btn btn-lightergray"></button>
                            </div>
                            <div class="digital-receipt-down-btn">
                                <button id="digital-receipt-down-btn" class="penny-btn btn-lightergray"></button>
                            </div>
                            <div class="digital-receipt-expand-btn">
                                <button id="digital-receipt-expand-btn" class="penny-btn btn-lightergray"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screen-right-side">
                <div class="operator-btn-area">
                    <!-- Home-Screen Buttons -->
                    <div class="tragetasche-btn home-screen-visible">
                        <button id="op-home-tragetasche-btn" class="penny-btn btn-yellow">TRAGE-<br />TASCHE</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-yellow disabled"></button>
                    </div>
                    <div class="nonfood-tax-btn home-screen-visible">
                        <button id="op-home-nonfood-tax-btn" class="penny-btn btn-yellow">NONFOOD<br />19%<br />volle
                            MwSt</button>
                    </div>
                    <div class="lebensmittel-tax-btn home-screen-visible">
                        <button id="op-home-lebensmittel-tax-btn"
                            class="penny-btn btn-yellow">LEBENSMITTEL<br />ermäßigte<br />MwSt</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-yellow disabled"></button>
                    </div>
                    <div class="bon-parken-btn home-screen-visible">
                        <button id="op-home-bon-parken-btn" class="penny-btn btn-green">BON PARKEN</button>
                    </div>
                    <div class="bonvorschub-btn home-screen-visible">
                        <button id="op-home-bonvorschub-btn"
                            class="penny-btn btn-green disabled">BON<br />VORSCHUB</button>
                    </div>
                    <div class="fundgeld-btn home-screen-visible">
                        <button id="op-home-fundgeld-btn" class="penny-btn btn-green">FUNDGELD</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-green disabled"></button>
                    </div>
                    <div class="rabatt-btn home-screen-visible">
                        <button id="op-home-rabatt-btn" class="penny-btn btn-red disabled">RABATT</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-green disabled"></button>
                    </div>
                    <div class="code-btn home-screen-visible">
                        <button id="op-home-code-btn" class="penny-btn btn-green">CODE</button>
                    </div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="kiste-btn home-screen-visible">
                        <button id="op-home-kiste-btn" class="penny-btn btn-green">KISTE</button>
                    </div>
                    <div class="preisabfrage-btn home-screen-visible">
                        <button id="op-home-preisabfrage-btn" class="penny-btn btn-green">PREIS-<br />ABFRAGE</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-green disabled"></button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-green disabled"></button>
                    </div>
                    <div class="alterpreis-neuerpreis-btn home-screen-visible">
                        <button id="op-home-alterpreis-neuerpreis-btn"
                            class="penny-btn btn-green disabled">ALTER-PREIS<br />NEUER-PREIS</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-green disabled"></button>
                    </div>
                    <div class="warenruecknahme-btn home-screen-visible">
                        <button id="op-home-warenruecknahme-btn"
                            class="penny-btn btn-green">WAREN-<br />RÜCKNAHME</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-green disabled"></button>
                    </div>
                    <div class="zeilenstorno-btn home-screen-visible">
                        <button id="op-home-zeilenstorno-btn"
                            class="penny-btn btn-green disabled">ZEILEN<br />STORNO</button>
                    </div>
                    <div class="eingabe-btn home-screen-visible">
                        <button id="op-home-eingabe-btn" class="penny-btn btn-green">EINGABE</button>
                    </div>
                    <div class="summe-btn home-screen-visible">
                        <button id="op-home-summe-btn" class="penny-btn btn-green">SUMME</button>
                    </div>
                    <div class="home-screen-visible">
                        <button class="penny-btn btn-green disabled"></button>
                    </div>
                    <div class="sofortstorno-btn home-screen-visible">
                        <button id="op-home-sofortstorno-btn"
                            class="penny-btn btn-green disabled">SOFORT<br />STORNO</button>
                    </div>

                    <!-- Sum-Screen-Buttons -->
                    <div class="sum-screen-5euro-btn sum-screen-visible">
                        <button id="op-sum-5euro-btn" class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-20euro-btn sum-screen-visible">
                        <button id="op-sum-20euro-btn" class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-empty sum-screen-visible"></div>
                    <div class="sum-screen-10euro-btn sum-screen-visible">
                        <button id="op-sum-10euro-btn" class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-50euro-btn sum-screen-visible">
                        <button id="op-sum-50euro-btn" class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-code-btn sum-screen-visible">
                        <button id="op-sum-code-btn" class="penny-btn btn-green disabled">CODE</button>
                    </div>
                    <div class="sum-screen-gutscheine-btn sum-screen-visible">
                        <button id="op-sum-gutscheine-btn" class="penny-btn btn-red">GUTSCHEINE</button>
                    </div>
                    <div class="sum-screen-paybackpay-btn sum-screen-visible">
                        <button id="op-sum-paybackpay-btn" class="penny-btn btn-red">PAYBACK<br />PAY</button>
                    </div>
                    <div class="sum-screen-eft-btn sum-screen-visible">
                        <button id="op-sum-eft-btn" class="penny-btn btn-red">EFT-Zahlung</button>
                    </div>
                    <div class="sum-screen-stimmtso-btn sum-screen-visible">
                        <button id="op-sum-stimmtso-btn" class="penny-btn btn-green">Stimmt so!</button>
                    </div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-yellow disabled"></button></div>
                    <div class="sum-screen-zeilenstorno-btn sum-screen-visible">
                        <button id="op-sum-zeilenstorno-btn" class="penny-btn btn-green">ZEILEN<br />STORNO</button>
                    </div>
                    <div class="sum-screen-eingabe-btn sum-screen-visible">
                        <button id="op-sum-eingabe-btn" class="penny-btn btn-green">EINGABE</button>
                    </div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="sum-screen-bar-btn sum-screen-visible">
                        <button id="op-sum-bar-btn" class="penny-btn btn-red">BAR</button>
                    </div>
                    <div class="sum-screen-sofortstorno-btn sum-screen-visible">
                        <button id="op-sum-sofortstorno-btn" class="penny-btn btn-green disabled">SOFORT<br />STORNO</button>
                    </div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    
                </div>

                <div class="modal-btn-area">
                    <div class="o-g-lose-btn">
                        <button id="mod-og-lose-btn" class="penny-btn btn-light-yellow">O&amp;G-LOSE</button>
                    </div>
                    <div class="o-g-alle-btn">
                        <button id="mod-og-alle-btn" class="penny-btn btn-light-yellow">O&amp;G-ALLE</button>
                    </div>
                    <div class="bake-off-btn">
                        <button id="mod-bakeoff-btn" class="penny-btn btn-light-yellow">BAKE-OFF</button>
                    </div>
                    <div class="blumen-btn">
                        <button id="mod-blumen-btn" class="penny-btn btn-light-yellow">BLUMEN</button>
                    </div>
                    <div class="getraenke-btn">
                        <button id="mod-getraenke-btn" class="penny-btn btn-light-yellow">GETRÄNKE</button>
                    </div>
                    <div class="kolo-btn">
                        <button id="mod-kolo-btn" class="penny-btn btn-light-yellow">KOLO</button>
                    </div>
                    <div class="home-btn">
                        <button id="mod-home-btn" class="penny-btn btn-lightergray"></button>
                    </div>
                    <div class="nonfood-btn">
                        <button id="mod-nonfood-btn" class="penny-btn btn-light-yellow">NON-FOOD</button>
                    </div>
                </div>
                <div class="big-info-area">
                    <div class="big-info-area-line1">
                        <div>
                            <span id="big-info-area-line1-text1"></span>
                            <span id="big-info-area-line1-text2"></span>
                        </div>
                    </div>
                    <div class="big-info-area-line2">
                        <div>
                            <span id="big-info-area-line2-text1"></span>
                            <span id="big-info-area-line2-text2"></span>
                        </div>
                    </div>
                </div>
                <div class="small-info-area">
                    <div class="bediener-no">
                        <button id="info-bediener-btn" class="penny-btn btn-light-gray">Bed.: XXXXXX</button>
                    </div>
                    <div class="small-info-area-empty">
                        <button class="penny-btn btn-light-gray"></button>
                    </div>
                    <div class="info-btn">
                        <button id="info-info-btn" class="penny-btn btn-light-gray">INFO</button>
                    </div>
                    <div class="payback-indicator">
                        <button class="penny-btn btn-light-gray">PAYBACK</button>
                    </div>
                    <div class="time-and-date">
                        <button class="penny-btn btn-light-gray">TT.MM.JJ HH:mm:ss</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="/res/script/register.js"></script>
    </div>
    <div id="size-error-div">
        <p>
            Um Den Penny-Kassen-Simulator anzuzeigen, muss dein Display oder Browserfenster mindestens 891 Pixel hoch
            sein und muss breiter sein als ein 3:2 Seitenverhältnis. (z.B. 16:10, 16:9, 4:3, 21:9, 2:1, etc)
        </p>
    </div>
</body>

</html>