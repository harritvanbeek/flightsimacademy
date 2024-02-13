<div class="card">
    <div class="card-body">
        <div class="nav_menu">
            <ul class="white-text">

                <li ng-click="setMenu('1', menuSet)"><a>Basic Terms</a></li>
                <li ng-if="getMenu('1')">
                    <ul class="white-text">
                        <li><a ui-sref="timeZone">Time zones</a></li>
                        <li><a ui-sref="natoAlphabet">Nato Phonetic alphabet</a></li>
                        <li><a ui-sref="numericalAlphabet">Numerical Phonetic alphabet</a></li>
                    </ul>
                </li>
                <p></p>
                <li ng-click="setMenu('2', menuSet)"><a>Traffic controllers</a></li>
                    <li ng-if="getMenu('2')">
                        <ul class="white-text">
                            <li><a>De Eerste stappen</a></li>
                            <li ng-click="setSubMenu('1', menuSetSub)"><a>Informatie per positie</a></li>
                                <li ng-if="getSubMenu('1')">
                                    <ul class="white-text">
                                        <li><a>Delivery</a></li>
                                        <li><a>Ground</a></li>
                                        <li><a>Tower</a></li>
                                        <li><a>Approach</a></li>
                                        <li><a>Radar</a></li>
                                    </ul>
                                </li>
                            <li><a>Noodgevallen-Emergencies</a></li>
                            <li><a>Examen informatie</a></li>
                        </ul>
                    </li>

                <li ng-click="setMenu('3', menuSet)"><a>Pilots</a></li>
                    <li ng-if="getMenu('3')">
                        <ul class="white-text">
                            <li ng-click="setSubMenu('2', menuSetSub)"><a>Eerste vlucht</a></li>
                                <li ng-if="getSubMenu('2')">
                                    <ul class="white-text">
                                        <li><a>Aanmelden bij ATC</a></li>
                                        <li><a>Vliegplan invullen</a></li>
                                        <li><a>Vliegplannen</a></li>
                                    </ul>
                                </li>
                            <li ng-click="setSubMenu('3', menuSetSub)"><a>Procedures</a></li>
                                <li ng-if="getSubMenu('3')">
                                    <ul class="white-text">
                                        <li><a>Groene velden</a></li>
                                        <li><a>Holdings</a></li>
                                        <li><a>SIDs</a></li>
                                        <li><a>STARs</a></li>
                                    </ul>
                                </li>
                            <li ng-click="setSubMenu('4', menuSetSub)"><a>Gevorderden</a></li>
                                <li ng-if="getSubMenu('4')">
                                    <ul class="white-text">
                                        <li><a>Approach en Go-Around</a></li>
                                        <li><a>Barosetting</a></li>
                                        <li><a>Descend Planning</a></li>
                                        <li><a>VFR Circuit</a></li>
                                    </ul>
                                </li>
                            <li><a>Noodgevallen-Emergencies</a></li>
                            <li><a>Examen informatie</a></li>
                        </ul>
                    </li>

                <li ng-click="setMenu('4', menuSet)">Airspace</li>
                <li ng-click="setMenu('5', menuSet)">Communication (R/T)</li>
                    <li ng-if="getMenu('5')">
                        <ul class="white-text">
                            <li><a ui-sref="info">Algemene informatie</a></li>
                            <li>Algemene Procedures</li>
                            <li>Basis uitdrukkingen</li>
                            <hr>
                            <li>VFR - Op en rond het vliegveld</li>
                            <li>VFR - Enroute</li>
                            <hr>
                            <li><a ui-sref="ifr_airport">IFR - Op en rond het vliegveld</a></li>
                            <li>IFR - Approach en Departure</li>
                            <li>IFR - Enroute</li>
                            <li>IFR Departure communication at EHAM - Main Aprons</li>
                        </ul>
                    </li>

                <li ng-click="setMenu('6', menuSet)">Meteorology</li>
                    <li ng-if="getMenu('6')">
                        <ul class="white-text">
                            <li><a>Metar / Sigmet/ Snowtam</a></li>
                            <li><a>Wind en temperatuur kaarten</a></li>
                        </ul>
                    </li>

                <li ng-click="setMenu('7', menuSet)">Documentation</li>

            </ul>

        </div>
    </div>
</div>
