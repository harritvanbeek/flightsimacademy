<div class="boann_city container">
    <div id="links" class="boannLinks page">
        <div class="row">
            <div class="col-md-4">
                <?php include "traningMenu.php"; ?>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body white-text">

                        <label>Simbrief Alias</label>
                        <input class="form-control" placeholder="Simbrief Alias" ng-model="form.simbrief_alias">
                        <button ng-click="simbrief(form)" class="btn btn-sm btn-success">Send</button>

                        <hr>

                        <h2>Start-up</h2>

                        <p><input type="text" class="form-control" placeholder="Approach gate" ng-model="form.approach_gate"><p>
                        <p><input type="text" class="form-control" placeholder="Approach runway" ng-model="form.approach_runway"><p>
                        <p>
                            <input type="number" class="form-control" placeholder="QNH/hPa" ng-model="form.qnh">
                            <span>Alleen nummers</span>
                        <p>

                        <table>
                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    <span ng-if="form.approach_airport" ng-bind-html="form.approach_airport"></span> <span ng-if="!form.approach_airport">Rotterdam</span> Delivery, <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>
                                </td>
                            </tr>
                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-broadcast-tower"></i></td>
                                <td>
                                    <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span> , <span ng-if="form.approach_airport" ng-bind-html="form.approach_airport"></span> <span ng-if="!form.approach_airport">Rotterdam</span> Delivery
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    Delivery, <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, <span ng-if="form.approach_gate"> {{form.approach_gate}},</span> <span ng-if="!form.approach_gate">D3,</span> <!-- information JULIET, --> IFR to <span ng-if="form.arrivle_airport" ng-bind-html="form.arrivle_airport"></span> <span ng-if="!form.arrivle_airport">London</span>, request start-up [1]</td></tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-broadcast-tower"></i></td>
                                <td><span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, start-up approved, runway <span ng-if="form.approach_runway" ng-bind-html="form.approach_runway"></span> <span ng-if="!form.approach_runway">24</span>, <span ng-if="form.qnh">QNH{{form.qnh}}</span> <span ng-if="!form.qnh">QNH1031</span></td></tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>Start-up approved, runway 24, <span ng-if="form.qnh">QNH{{form.qnh}}</span> <span ng-if="!form.qnh">QNH1031</span> <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span></td>
                            </tr>
                        </table>
                        <br>

                        <p>[1] Op alle velden in Nederland, behalve Schiphol,<br> wordt eerst de start-up gegeven en daarna pas de departure clearence</p>
                        <p>[2] Hou voor de start-up een vaste rijtje aan:<br> "<strong>[callsign]</strong>  Start-up approved, Runway <strong>[RW]</strong>, QNH <strong>[QNH waarde]</strong>"</p>
                        <hr>

                        <h2>Klaringen</h2>
                        <p><input type="text" class="form-control" placeholder="Approach Route" ng-model="form.approach_route"><p>
                        <p><input type="text" class="form-control" placeholder="Taxi Radio" ng-model="form.approach_radio"><p>


                        <table>
                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    Delivery, <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, Request departure clearence
                                </td>
                            </tr>
                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-broadcast-tower"></i></td>
                                <td>
                                    <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span> cleared to <span ng-if="form.arrivle_airport" ng-bind-html="form.arrivle_airport"></span> <span ng-if="!form.arrivle_airport">London</span>, <span ng-if="form.approach_route" ng-bind-html="form.approach_route"></span><span ng-if="!form.approach_route">REFSO 1B</span> Departure, initial climb <span ng-if="form.initial_altitude" ng-bind-html="form.initial_altitude"></span> <span ng-if="!form.initial_altitude">3000ft,</span> squawk 7347 [3]
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    Cleared to <span ng-if="form.arrivle_airport" ng-bind-html="form.arrivle_airport"></span> <span ng-if="!form.arrivle_airport">London</span>, <span ng-if="form.approach_route" ng-bind-html="form.approach_route"></span><span ng-if="!form.approach_route">REFSO 1B</span> departure, runway <span ng-if="form.approach_runway" ng-bind-html="form.approach_runway"></span> <span ng-if="!form.approach_runway">24</span>, initial climb <span ng-if="form.initial_altitude" ng-bind-html="form.initial_altitude"></span> <span ng-if="!form.initial_altitude">3000ft,</span> sqauwk 7347. <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-broadcast-tower"></i></td>
                                <td>
                                    <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, readback correct. Contact Rotterdam tower on <span ng-if="form.approach_radio" ng-bind-html="form.approach_radio"></span><span ng-if="!form.approach_radio">118.2</span> for taxi
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    <span ng-if="form.approach_radio" ng-bind-html="form.approach_radio"></span><span ng-if="!form.approach_radio">118.2</span>, <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>
                                </td>
                            </tr>
                        </table>
                        <br>
                            <p>[3] Hou voor de departure klaring ook een vast rijtje aan: "<strong>[callsign]</strong> cleared to <strong>[destination],<br> [sid]</strong> departure, Runway <strong>[RW]</strong>*, Initial climb <strong>[IC]</strong>, Squawk <strong>[code]</strong>".</p>
                            <p>Indien de baan in gebruik al gemeld is bij start-up hoeft dit niet nog eens in de klaring te zitten.</p>

                        <hr>
                        <h2>Taxi en take-off</h2>
                        <table>
                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    <span ng-if="form.approach_airport" ng-bind-html="form.approach_airport"></span> <span ng-if="!form.approach_airport">Rotterdam</span> Tower, <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, <span ng-if="form.approach_gate"> {{form.approach_gate}},</span> <span ng-if="!form.approach_gate">D3,</span>, request taxi.
                                </td>
                            </tr>
                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-broadcast-tower"></i></td>
                                <td>
                                    <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, taxi holding point runway <span ng-if="form.approach_runway" ng-bind-html="form.approach_runway"></span> <span ng-if="!form.approach_runway">24</span> via NOVEMBER and VICTOR
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    Taxi holding point runway 24, via NOVEMBER and VICTOR <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span><br>
                                    Ready for departure <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-broadcast-tower"></i></td>
                                <td>
                                    <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, winds 190, 15 knots, runway 24, cleared take-off
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    Cleared take-off, <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-broadcast-tower"></i></td>
                                <td>
                                    <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>, contact <span ng-if="form.approach_airport" ng-bind-html="form.approach_airport"></span> <span ng-if="!form.approach_airport">Rotterdam</span> Approach on xxx.xxx
                                </td>
                            </tr>

                            <tr class="white-text">
                                <td width="45px"><i class="fas fa-plane"></i></td>
                                <td>
                                    xxx.xxx, <span ng-if="form.callsign" ng-bind-html="form.callsign"></span> <span ng-if="!form.callsign">KLM123</span>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>


        </div>


    </div>
</div>
