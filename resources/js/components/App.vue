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
                    <label for="importar">Importar desde excel <i class="pi pi-upload"></i></label>
                    <input @change="upload($event)" type="file" accept=".xlsx" id="importar" ref="inputFile" class="form-control">
                    <template #header>
                        <div class="d-flex justify-content-center w-100">
                            <img src="https://getaldea.com/images/aldea-navbar-logo.svg"/>
                        </div>
                    </template>
                    <div v-for="(value, key) in model" :key="key" class="row">
                        <div class="d-flex flex-column">
                            <form class="m-3" @submit.prevent="submit">
                                <div class="row pt-2 pb-2">
                                    <label class="p-0 m-0 text-muted" for="description">Descripción gasto</label>
                                    <InputText id="description" type="text" v-model="value.description"/>
                                    <small class="text-danger" v-if="errors && errors['description']" id="description-help">* {{  displayError('email') }}.</small>
                                </div>
                                <div class="row pt-2 pb-2">
                                    <label class="p-0 m-0 text-muted" for="amount">Monto</label>
                                    <InputText id="amount" type="text" v-model="value.amount"/>
                                    <small class="text-danger" v-if="errors && errors['amount']" id="amount-help">* {{  displayError('amount') }}.</small>
                                </div>
                                <div class="row pt-2 pb-2">
                                    <label class="p-0 m-0 text-muted" for="amount">Fecha</label>
                                    <Calendar class="p-0 m-0" v-model="value.date" dateFormat="yy-mm-dd"/>
                                    <small class="text-danger" v-if="errors && errors['amount']" id="amount-help">* {{  displayError('amount') }}.</small>
                                </div>
                                <div class="row pt-2 pb-2">
                                    <label class="p-0 m-0 text-muted" for="category">Categoría</label>
                                    <Dropdown v-model="value.category_id" :options="categories" optionLabel="name" optionValue="id" placeholder="Selecciona una categoría" class="w-full md:w-14rem" />
                                    <small class="text-danger" v-if="errors && errors['category_id']" id="category-help">* {{  displayError('category_id') }}.</small>
                                </div>
                                <div class="row pt-2 pb-2">
                                    <Button v-if="!loading" type="submit" label="Guardar" />
                                    <small class="text-danger mt-2" v-if="!success && error" id="username-help">* {{  error }}</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </Panel>
            </div>
        </div>
</template>

<script>
    
    import Panel from 'primevue/panel';
    import InputText from 'primevue/inputtext';
    import Button from 'primevue/button';
    import Calendar from 'primevue/calendar';
    import Dropdown from 'primevue/dropdown';
    import FileUpload from 'primevue/fileupload';
    import { bill } from '../models/billModel';
    import categoryService from '../services/categoryService';
    import importService from '../services/uploadService';

    export default {
        props: {
            token:null
        },
        data() {
            return {
                data: null,
                error: null,
                errors: null,
                loading: false,
                success: false,
                categories: null,
                model: [bill],
                file:null
            };
        },
        components:{
            Panel,
            InputText,
            Calendar,
            Dropdown,
            Button,
            FileUpload
        },
        mounted(){
            this.getCategories();
        },
        methods: {
            upload(e){
                
                const [xlsx] = Array.from(e.target.files);

                console.log('xlsx', xlsx);
                
                const data = {
                    file: xlsx
                };
                
                importService.post('/excel/import', data)
                .then((response) => {
                    
                    if(response.data.status){

                        this.$swal.fire({
                            title: `${response.data.data.msg}`,
                            icon: 'success',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });

                    }
                })
                .catch(err => console.warn);

            },
            displayError(key){
                const [error] = this.errors[key];
                return error;
            },
            submit(){
                
            },
            getCategories(){

                categoryService.get('categories')
                .then((response) => {
                    if(response.data.status){
                        const { data } = response.data;
                        this.categories = data;
                    }
                })
                .catch(err => console.warn);
            }
        }
    }
</script>