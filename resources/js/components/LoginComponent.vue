<template>
    <div>

     <!-- Authentication card start -->

                        <form class="md-float-material form-material">
                            <div class="text-center">
                                <img src="/assets/images/logo.png" alt="logo.png">
                            </div>
                            <div class="auth-box card">
                                <div class="card-block">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-center">Log in</h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary">
                                    <input type="text" name="email" class="form-control" placeholder="Email address" v-model="email">
                                        <span class="form-bar text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                                    </div>
                                    <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" placeholder="Password" v-model="password">
                                    <span class="form-bar text-danger" v-if="errors.password">{{ errors.password[0] }}</span>
                                    </div>
                                    <div class="row m-t-25 text-left">
                                        <div class="col-12">
                                            <div class="checkbox-fade fade-in-primary d-">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember</span>
                                                </label>
                                            </div>
                                            <div class="forgot-phone text-right f-right">
                                            <a href="/forogt/password" class="text-right f-w-600"> Forgot password</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m-t-30">
                                        <div class="col-md-12">

                                        <button type="button" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20" @click.prevent="login">
                                            <pulse-loader :loading="loading" :color="color" :size="size"></pulse-loader>
                                             <span v-show="show_button_text">Sign in</span>
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="text-inverse text-left m-t-10"><b>Developed by: Bole</b></p>

                                        </div>
                                        <div class="col-md-2">
                                            <img src="assets\images\auth\Logo-small-bottom.png" alt="small-logo.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->

    </div>
</template>



<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue'
export default {

components: {
PulseLoader
},

    data() {

        return {
            email: '',
            password: '',
            errors: {},
            color: '#972700',
            size: '15px',
            margin: '2px',
            radius: '100%',
            loading: false,
            sign_in: '',
            show_button_text: true,
        }

    },


    methods: {

        login() {

            this.loading = true;
            this.show_button_text = false;

            let data = {
                password: this.password,
                email: this.email
            }

            axios.post('/login', data).then( response => {

                let user = JSON.stringify(response.data.user)
                let jwt = response.data.token
                localStorage.setItem('insurance.user', user)
                localStorage.setItem('insurance.jwt', jwt)
                window.location.href = "/home"
                this.loading = false;

            }).catch( error => {
                this.loading = false;
                this.show_button_text = true;
                this.errors = error.response.data.errors;
            })
        }

    },

}
</script>




<style scoped>

</style>
