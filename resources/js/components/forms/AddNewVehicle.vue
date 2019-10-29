<template>
    <div>


          <!-- Page-body start -->
                   <div class="page-body" v-if="hide_form">
                    <!-- DOM/Jquery table start -->
                    <div class="card">
                        <div class="card-header">
                            <h2>Forma za snimanje novo vozila u bazu podataka</h2>
                            <span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span>
                        </div>

                        <div class="card-block">


                            <form class="j-pro" id="j-pro">
                                                                <!-- end /.header-->
                                                                <div class="j-content">
                                                                    <!-- start name -->
                                                                    <div class="j-row">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="first_name">
                                                            <i class="icofont icofont-ui-user"></i>
                                                        </label>
                                                                                <input type="text" id="first_name" name="first_name" placeholder="First name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="last_name">
                                                            <i class="icofont icofont-ui-user"></i>
                                                        </label>
                                                                                <input type="text" id="last_name" name="last_name" placeholder="Last name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end name -->
                                                                    <!-- start email phone -->
                                                                    <div class="j-row">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="email">
                                                            <i class="icofont icofont-envelope"></i>
                                                        </label>
                                                                                <input type="email" placeholder="Email" id="email" name="email">
                                                                            </div>
                                                                        </div>
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="phone">
                                                            <i class="icofont icofont-phone"></i>
                                                        </label>
                                                                                <input type="text" placeholder="Phone" id="phone" name="phone">
                                                                                <span class="j-tooltip j-tooltip-right-top">Your contact phone number</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end email phone -->
                                                                    <div class="divider gap-bottom-25"></div>
                                                                    <!-- start country -->
                                                                    <div class="j-unit">
                                                                        <label class="j-input j-select">
                                                    <select name="country">
                                                        <option value="" selected="">Select country</option>
                                                        <option value="Australia">Australia</option>
                                                        <option value="Austria">Austria</option>
                                                        <option value="Brazil">Brazil</option>
                                                        <option value="Canada">Canada</option>
                                                        <option value="Germany">Germany</option>
                                                        <option value="India">India</option>
                                                        <option value="Italy">Italy</option>
                                                        <option value="Japan">Japan</option>
                                                        <option value=">Netherlands">Netherlands</option>
                                                        <option value=">New Zealand">New Zealand</option>
                                                        <option value="Philippines">Philippines</option>
                                                        <option value="Portugal">Portugal</option>
                                                        <option value="South Africa">South Africa</option>
                                                        <option value="Spain">Spain</option>
                                                        <option value="Switzerland">Switzerland</option>
                                                        <option value="Sweden">Sweden</option>
                                                        <option value="Turkey">Turkey</option>
                                                        <option value="j-United Arab Emirates">j-United Arab Emirates</option>
                                                        <option value="j-United Kingdom">j-United Kingdom</option>
                                                        <option value="USA">USA</option>
                                                    </select>
                                                    <i></i>
                                                </label>
                                                                    </div>
                                                                    <!-- end country -->
                                                                    <!-- start city post code -->
                                                                    <div class="j-row">
                                                                        <div class="j-span8 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="city">
                                                            <i class="icofont icofont-building"></i>
                                                        </label>
                                                                                <input type="text" id="city" placeholder="City" name="city">
                                                                            </div>
                                                                        </div>
                                                                        <div class="j-span4 j-unit">
                                                                            <div class="j-input">
                                                                                <label class="j-icon-right" for="post">
                                                            <i class="icofont icofont-file-code"></i>
                                                        </label>
                                                                                <input type="text" id="post" placeholder="Post code" name="post_code">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end city post code -->
                                                                    <!-- start address -->
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <label class="j-icon-right" for="address">
                                                        <i class="icofont icofont-building"></i>
                                                    </label>
                                                                            <input type="text" id="address" placeholder="Address" name="address">
                                                                        </div>
                                                                    </div>
                                                                    <!-- end address -->
                                                                    <div class="divider gap-bottom-25"></div>
                                                                    <!-- start position -->
                                                                    <div class="j-unit">
                                                                        <label class="j-input j-select">
                                                    <select name="position">
                                                        <option value="" selected="">Choose desired position</option>
                                                        <option value="tech lead">Tech Lead</option>
                                                        <option value="product manager">Product Manager</option>
                                                        <option value="senior developer">Senior Developer</option>
                                                        <option value="middle developer">Middle Developer</option>
                                                        <option value="junior developer">Junior Developer</option>
                                                        <option value="QA specialist">QA Specialist</option>
                                                        <option value="system administrator">System Administrator</option>
                                                    </select>
                                                    <i></i>
                                                </label>
                                                                    </div>
                                                                    <!-- end position -->
                                                                    <!-- start message -->
                                                                    <div class="j-unit">
                                                                        <div class="j-input">
                                                                            <textarea placeholder="Additional info" spellcheck="false" name="message"></textarea>
                                                                            <span class="j-tooltip j-tooltip-right-top">Any useful information about you</span>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end message -->
                                                                    <!-- start files -->
                                                                    <div class="j-row">
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input j-append-small-btn">
                                                                                <div class="j-file-button">
                                                                                    Browse
                                                                                    <input type="file" name="file1" onchange="document.getElementById('file1_input').value = this.value;">
                                                                                </div>
                                                                                <input type="text" id="file1_input" readonly="" placeholder="add your CV">
                                                                                <span class="j-hint">Only: doc / docx / xls /xlsx, less 1Mb</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="j-span6 j-unit">
                                                                            <div class="j-input j-append-small-btn">
                                                                                <div class="j-file-button">
                                                                                    Browse
                                                                                    <input type="file" id="file2" name="file2" onchange="document.getElementById('file2_input').value = this.value;">
                                                                                </div>
                                                                                <input type="text" id="file2_input" readonly="" placeholder="add your CV">
                                                                                <span class="j-hint">Only: doc / docx / xls /xlsx, less 1Mb</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end files -->
                                                                    <!-- start response from server -->
                                                                    <div class="j-response"></div>
                                                                    <!-- end response from server -->
                                                                </div>
                                                                <!-- end /.content -->
                                                                <div class="j-footer">
                                                                    <button class="btn btn-primary" @click.prevent="saveVehicle">Snimi vozilo</button>
                                                                    <button type="reset" class="btn btn-default m-r-20">Reset</button>
                                                                </div>
                                                                <!-- end /.footer -->
                                                            </form>



                        </div>

                    </div>

                   </div>

    </div>
</template>



<script>
import store from '../../store/store';
import { mapState } from 'vuex';

export default {

    data() {
        return {

            vozilo: '',
            reg_broj: '',
            broj_motora: '',

        }


    },


    computed: {

        ...mapState({
            hide_form: state => state.hide_vehicle_form,
        }),

    },

    methods: {

        saveVehicle()
        {
            let data = {
                vozilo: this.vozilo,
                reg_broj: this.reg_broj,
                broj_motora: this.broj_motora,
            };

            store.dispatch('saveVehicle', data); // save vehicle in vuex state
        }

    }

}
</script>



<style scoped>

</style>
