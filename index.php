<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penny-Kassen-Sim</title>
    <link rel="stylesheet" href="/res/style/main.min.css">
</head>

<body>
    <div class="main" id="main-div">
        <div class="register-screen" id="register-screen">
            <div class="screen-left-side">
                <div class="numpad-area">
                    <div class="numpad-op-btn-area">
                        <div class="numpad-back-btn">
                            <button class="penny-btn btn-orange"></button>
                        </div>
                        <div class="numpad-delete-btn">
                            <button class="penny-btn btn-light-red">LÖSCHEN</button>
                        </div>
                        <div class="numpad-menge-btn">
                            <button class="penny-btn btn-green">MENGE</button>
                        </div>
                        <div class="numpad-eingabe-btn">
                            <button class="penny-btn btn-green disabled">EIN<br />GABE</button>
                        </div>
                    </div>
                    <div class="numpad-pad-area">
                        <div class="numpad-line">
                                <span></span>
                        </div>
                        <div class="numpad-pad-btn-area">
                            <div class="numpad-0-btn">
                                <button class="penny-btn btn-dark-gray">0</button>
                            </div>
                            <div class="numpad-00-btn">
                                <button class="penny-btn btn-dark-gray">00</button>
                            </div>
                            <div class="numpad-1-btn">
                                <button class="penny-btn btn-dark-gray">1</button>
                            </div>
                            <div class="numpad-3-btn">
                                <button class="penny-btn btn-dark-gray">3</button>
                            </div>
                            <div class="numpad-2-btn">
                                <button class="penny-btn btn-dark-gray">2</button>
                            </div>
                            <div class="numpad-4-btn">
                                <button class="penny-btn btn-dark-gray">4</button>
                            </div>
                            <div class="numpad-5-btn">
                                <button class="penny-btn btn-dark-gray">5</button>
                            </div>
                            <div class="numpad-6-btn">
                                <button class="penny-btn btn-dark-gray">6</button>
                            </div>
                            <div class="numpad-7-btn">
                                <button class="penny-btn btn-dark-gray">7</button>
                            </div>
                            <div class="numpad-8-btn">
                                <button class="penny-btn btn-dark-gray">8</button>
                            </div>
                            <div class="numpad-9-btn">
                                <button class="penny-btn btn-dark-gray">9</button>
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
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item01">
                            <span id="digital-receipt-list-item01-name"></span><span
                                id="digital-receipt-list-item01-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item02">
                            <span id="digital-receipt-list-item02-name"></span><span
                                id="digital-receipt-list-item02-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item03">
                            <span id="digital-receipt-list-item03-name"></span><span
                                id="digital-receipt-list-item03-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item04">
                            <span id="digital-receipt-list-item04-name"></span><span
                                id="digital-receipt-list-item04-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item05">
                            <span id="digital-receipt-list-item05-name"></span><span
                                id="digital-receipt-list-item05-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item06">
                            <span id="digital-receipt-list-item06-name"></span><span
                                id="digital-receipt-list-item06-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item07">
                            <span id="digital-receipt-list-item07-name"></span><span
                                id="digital-receipt-list-item07-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item08">
                            <span id="digital-receipt-list-item08-name"></span><span
                                id="digital-receipt-list-item08-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item09">
                            <span id="digital-receipt-list-item09-name"></span><span
                                id="digital-receipt-list-item09-price"></span>
                        </div>
                        <div class="digital-receipt-list-item" id="digital-receipt-list-item10">
                            <span id="digital-receipt-list-item10-name"></span><span
                                id="digital-receipt-list-item10-price"></span>
                        </div>
                    </div>
                    <div class="digital-receipt-bottom-area">
                        <div class="digital-receipt-sum-area">
                            <span id="digital-receipt-sum"></span>
                        </div>
                        <div class="digital-receipt-btn-area">
                            <div class="digital-receipt-up-btn">
                                <button class="penny-btn btn-lightergray"></button>
                            </div>
                            <div class="digital-receipt-down-btn">
                                <button class="penny-btn btn-lightergray"></button>
                            </div>
                            <div class="digital-receipt-expand-btn">
                                <button class="penny-btn btn-lightergray"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screen-right-side">
                <div class="operator-btn-area">
                    <!-- Home-Screen Buttons -->
                    <div class="eingabe-btn home-screen-visible">
                        <button class="penny-btn btn-green">EINGABE</button>
                    </div>
                    <div class="kiste-btn home-screen-visible">
                        <button class="penny-btn btn-green">KISTE</button>
                    </div>
                    <div class="preisabfrage-btn home-screen-visible">
                        <button class="penny-btn btn-green">PREIS-<br />ABFRAGE</button>
                    </div>
                    <div class="warenruecknahme-btn home-screen-visible">
                        <button class="penny-btn btn-green">WAREN-<br />RÜCKNAHME</button>
                    </div>
                    <div class="summe-btn home-screen-visible">
                        <button class="penny-btn btn-green">SUMME</button>
                    </div>
                    <div class="zeilenstorno-btn home-screen-visible">
                        <button class="penny-btn btn-green disabled">ZEILEN<br />STORNO</button>
                    </div>
                    <div class="sofortstorno-btn home-screen-visible">
                        <button class="penny-btn btn-green disabled">SOFORT<br />STORNO</button>
                    </div>
                    <div class="tragetasche-btn home-screen-visible">
                        <button class="penny-btn btn-yellow">TRAGE-<br />TASCHE</button>
                    </div>
                    <div class="rabatt-btn home-screen-visible">
                        <button class="penny-btn btn-red disabled">RABATT</button>
                    </div>
                    <div class="fundgeld-btn home-screen-visible">
                        <button class="penny-btn btn-green">FUNDGELD</button>
                    </div>
                    <div class="bonvorschub-btn home-screen-visible">
                        <button class="penny-btn btn-green disabled">BON<br />VORSCHUB</button>
                    </div>
                    <div class="bon-parken-btn home-screen-visible">
                        <button class="penny-btn btn-green">BON PARKEN</button>
                    </div>
                    <div class="code-btn home-screen-visible">
                        <button class="penny-btn btn-green">CODE</button>
                    </div>
                    <div class="alterpreis-neuerpreis-btn home-screen-visible">
                        <button class="penny-btn btn-green disabled">ALTER-PREIS<br />NEUER-PREIS</button>
                    </div>
                    <div class="nonfood-tax-btn home-screen-visible">
                        <button class="penny-btn btn-yellow">NONFOOD<br />19%<br />volle MwSt</button>
                    </div>
                    <div class="lebensmittel-tax-btn home-screen-visible">
                        <button class="penny-btn btn-yellow">LEBENSMITTEL<br />ermäßigte<br />MwSt</button>
                    </div>
                    <div class="home-screen-visible"><button class="penny-btn btn-yellow disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-yellow disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="home-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <!-- Sum-Screen-Buttons -->
                    <div class="sum-screen-code-btn sum-screen-visible">
                        <button class="penny-btn btn-green disabled">CODE</button>
                    </div>
                    <div class="sum-screen-gutscheine-btn sum-screen-visible">
                        <button class="penny-btn btn-red">GUTSCHEINE</button>
                    </div>
                    <div class="sum-screen-paybackpay-btn sum-screen-visible">
                        <button class="penny-btn btn-red">PAYBACK<br />PAY</button>
                    </div>
                    <div class="sum-screen-stimmtso-btn sum-screen-visible">
                        <button class="penny-btn btn-green">Stimmt so!</button>
                    </div>
                    <div class="sum-screen-zeilenstorno-btn sum-screen-visible">
                        <button class="penny-btn btn-green">ZEILEN<br />STORNO</button>
                    </div>
                    <div class="sum-screen-sofortstorno-btn sum-screen-visible">
                        <button class="penny-btn btn-green disabled">SOFORT<br />STORNO</button>
                    </div>
                    <div class="sum-screen-5euro-btn sum-screen-visible">
                        <button class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-10euro-btn sum-screen-visible">
                        <button class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-20euro-btn sum-screen-visible">
                        <button class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-50euro-btn sum-screen-visible">
                        <button class="penny-btn"></button>
                    </div>
                    <div class="sum-screen-bar-btn sum-screen-visible">
                        <button class="penny-btn btn-red">BAR</button>
                    </div>
                    <div class="sum-screen-eft-btn sum-screen-visible">
                        <button class="penny-btn btn-red">EFT-Zahlung</button>
                    </div>
                    <div class="sum-screen-eingabe-btn sum-screen-visible">
                        <button class="penny-btn btn-green">EINGABE</button>
                    </div>
                    <div class="sum-screen-empty sum-screen-visible"></div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-yellow disabled"></button></div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                    <div class="sum-screen-visible"><button class="penny-btn btn-green disabled"></button></div>
                </div>
                <div class="modal-btn-area">
                    <div class="o-g-lose-btn">
                        <button class="penny-btn btn-light-yellow">O&amp;G-LOSE</button>
                    </div>
                    <div class="o-g-alle-btn">
                        <button class="penny-btn btn-light-yellow">O&amp;G-ALLE</button>
                    </div>
                    <div class="bake-off-btn">
                        <button class="penny-btn btn-light-yellow">BAKE-OFF</button>
                    </div>
                    <div class="blumen-btn">
                        <button class="penny-btn btn-light-yellow">BLUMEN</button>
                    </div>
                    <div class="getraenke-btn">
                        <button class="penny-btn btn-light-yellow">GETRÄNKE</button>
                    </div>
                    <div class="kolo-btn">
                        <button class="penny-btn btn-light-yellow">KOLO</button>
                    </div>
                    <div class="home-btn">
                        <button class="penny-btn btn-lightergray"></button>
                    </div>
                    <div class="nonfood-btn">
                        <button class="penny-btn btn-light-yellow">NON-FOOD</button>
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
                            <span id="big-info-area-line1-text1"></span>
                            <span id="big-info-area-line1-text2"></span>
                        </div>
                    </div>
                </div>
                <div class="small-info-area">
                    <div class="bediener-no">
                        <button class="penny-btn btn-light-gray">Bed.: XXXXXX</button>
                    </div>
                    <div class="small-info-area-empty">
                        <button class="penny-btn btn-light-gray"></button>
                    </div>
                    <div class="info-btn">
                        <button class="penny-btn btn-light-gray">INFO</button>
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
    </div>
    <div id="size-error-div">
        <p>
        Um Den Penny-Kassen-Simulator anzuzeigen, muss dein Display oder Browserfenster mindestens 891 Pixel hoch sein und muss breiter sein als ein 3:2 Seitenverhältnis. (z.B. 16:10, 16:9, 4:3, 21:9, 2:1, etc)
        </p>
    </div>
</body>

</html>