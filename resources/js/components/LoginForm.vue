<template>
        <div class="row justify-content-center p-0 m-0">
            <div class="col-6 p-0 m-0">
                    <div v-if="loading" class="d-flex flex-column align-items-center justify-content-center pt-4 pb-4">
                        <i  class="pi pi-spin pi-spinner" style="font-size: 5rem; color: green"></i>
                        <span class="s20 m-4 font-weight-bold">
                        Redireccionando ...
                        </span>
                    </div>
                    <Panel v-if="!loading">
                        <template #header>
                            <div class="d-flex justify-content-center w-100">
                                <img src="https://getaldea.com/images/aldea-navbar-logo.svg"/>
                            </div>
                        </template>
                        <div class="d-flex flex-column">
                            <form class="m-3" @submit.prevent="submit">
                                <div class="row pt-2 pb-2">
                                    <label class="p-0 m-0 text-muted" for="username">Email</label>
                                    <InputText id="username" type="text" v-model="user"/>
                                    <small class="text-danger" v-if="errors && errors['email']" id="username-help">* {{  displayError('email') }}.</small>
                                </div>
                                <div class="row pt-2 pb-2">
                                    <label class="p-0 m-0 text-muted" for="pass">Password</label>
                                    <InputText id="pass" type="password" v-model="password"/>
                                    <small class="text-danger" v-if="errors && errors['password']" id="username-help">* {{  displayError('password') }}.</small>
                                </div>

                                <div class="row pt-2 pb-2">
                                    <label class="p-0 m-0 text-muted" for="pass">Password</label>
                                    <small class="text-danger" v-if="errors && errors['password']" id="username-help">* {{  displayError('password') }}.</small>
                                </div>

                                <div class="row pt-2 pb-2">
                                    <Button v-if="!loading" type="submit" label="Login" />
                                    <small class="text-danger mt-2" v-if="!success && error" id="username-help">* {{  error }}</small>
                                </div>
                            </form>
                        </div>
                    </Panel>
            </div>
        </div>
</template>

<script>

import Panel from 'primevue/panel';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';
import FloatLabel from 'primevue/floatlabel';
import Button from 'primevue/button';
import loginService from '../services/loginService';
import { setToken} from '../services/mainService'

export default {
    data() {
        return {
            user:'',
            password:'',
            data: null,
            error: null,
            errors: null,
            loading: false,
            success: false
        };
    },
    components:{
        Panel,
        InputText,
        Password,
        FloatLabel,
        Button
    },
    mounted(){

    },
    methods: {

        displayError(key){
            const [error] = this.errors[key];
            return error;
        },
        submit(){
            
            const data =  {
                email: this.user,
                password: this.password
            }

            loginService.post('login', data).then((response) => {
                if(response.data.status){

                    const { token } = response.data.data.authorization;

                    if(token){

                        setToken(token);

                        this.loading = true;

                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }

                }else{
                    const { error } = response.data.data;
                    this.error = error;
                }
            })
            .catch((error) => {
                
                console.warn("Error al iniciar sesión: " + error.response.data.data);
                        
                const { data, msg } = error.response.data;

                this.errors = data;
            });
        }
    }
}

</script>