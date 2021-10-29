<template>
    <div>
        <h3 class="text-center">Crear Vehiculo</h3>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="">
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                Datos de Propietario
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(*) Identificación</label>
                                
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" v-model="propietario.identificacion">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" @click="searchPropietario">Buscar</button>
                                    </div>
                                </div>
                                <!--
                                <input type="text" class="form-control" v-model="propietario.identificacion" @blur="searchPropietario">
                                -->
                                <small v-if="buscando_propietario">Buscando propietario...</small>
                                <small v-if="registrar_propietario">Complete datos de propietario para Registrarlo</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(*) Nombres</label>
                                <input type="text" class="form-control" v-model="propietario.nombres">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Correo</label>
                                <input type="email" class="form-control" v-model="propietario.email">
                            </div>
                        </div>
                        <div class="col-12 text-center" v-if="registrar_propietario && validarFormPropietario">
                            <button class="btn btn-success" type="button" @click="addPropietario">Registrar Propietario</button>
                        </div>
                        <div class="col-12" v-if="guardando_propietario">
                            <p>Guardando datos de Propietario...</p>
                        </div>
                    </div>

                    <div class="row mt-3 py-2">
                        <div class="col-12">
                            <h4>
                                Datos de Vehículo
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>(*) Placa</label>
                                <input type="text" class="form-control" v-model="vehiculo.placa">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo de Vehículo</label>
                                <select class="form-control" v-model="vehiculo.tipo_id">
                                    <option v-bind:value="''">-- Seleccione --</option>
                                    <option v-for="tipo in tipos" :key="tipo.id" v-bind:value="tipo.id">{{ tipo.descripcion }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Marca</label>
                                <select class="form-control" v-model="marca_id" @change="searchModelos()">
                                    <option v-bind:value="''">-- Seleccione --</option>
                                    <option v-for="marca in marcas" :key="marca.id" v-bind:value="marca.id">{{ marca.nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Modelo</label>
                                <select class="form-control" v-model="vehiculo.modelo_id">
                                    <option v-bind:value="''">-- Seleccione --</option>
                                    <option v-for="modelo in modelos" :key="modelo.id" v-bind:value="modelo.id">{{ modelo.descripcion }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Año</label>
                                <input type="text" class="form-control" v-model="vehiculo.anio">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Color</label>
                                <input type="text" class="form-control" v-model="vehiculo.color">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Detalle</label>
                                <textarea class="form-control" v-model="vehiculo.detalle"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success" @click="addVehiculo">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                propietario: {},
                vehiculo: {},

                marcas: [],
                modelos: [],
                marca_id: '',

                tipos: [],
                buscando_propietario: false,
                guardando_propietario: false,
                registrar_propietario: false,

            }
        },

        computed: {
            validarFormPropietario() {
                return (this.propietario.identificacion.length > 4 && this.propietario.nombres.length > 2 && this.propietario.email.length > 3)
            },
            validaPropietario() {
                return (this.vehiculo.propietario_id !== undefined)
            },
            validaFormVehiculo() {
                console.log( this.vehiculo )
                const resp = (
                    (this.vehiculo.placa != undefined && this.vehiculo.placa.length > 0) &&
                    (this.vehiculo.color != undefined && this.vehiculo.color.length > 0) &&
                    (this.vehiculo.anio != undefined && this.vehiculo.anio.length > 0) &&
                    (this.vehiculo.tipo_id != undefined && this.vehiculo.tipo_id.length > 0) &&
                    (this.vehiculo.modelo_id != undefined && this.vehiculo.modelo_id.length > 0)
                )
                console.log( `Resp FVH: ${resp}` )
                return resp
            }
        },

        async created() {

            this.vehiculo.tipo_id = ``
            this.vehiculo.modelo_id = ``
            
            await this.axios
                .get('http://localhost:8000/api/marcas/')
                .then(response => {
                    this.marcas = response.data;
                });

            await this.axios
                .get('http://localhost:8000/api/tipos/')
                .then(response => {
                    this.tipos = response.data;
                });
        },
        methods: {
            async addVehiculo() {
                this.axios
                    .post('http://localhost:8000/api/vehiculo', this.vehiculo)
                    .then(response => (
                        this.$router.push({ name: 'listado_vehiculos' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            },

            async addPropietario() {

                if( this.validarFormPropietario() ){
                    this.guardando_propietario = true

                    if( this.propietario.id !== undefined && this.propietario.id > 0 ){
                        //se actualiza
                        /*this.axios
                            .patch(`http://localhost:8000/api/persona/${this.propietario.id}`, this.propietario)
                            .then((res) => {
                                this.propietario = res.data
                            })
                            .catch(err => console.log(err))
                            .finally(() => this.guardando_propietario = false)
                            */
                    }
                    else{
                        //se registra
                        await this.axios
                            .post('http://localhost:8000/api/persona', this.propietario)
                            .then(response => (
                                this.propietario = response.data.persona ?? {}
                            ))
                            .catch(err => console.log(err))
                            .finally(() => this.guardando_propietario = false)
                            this.registrar_propietario = false
                    }

                    this.vehiculo.propietario_id = this.propietario.identificacion         
                }
                else{
                    alert();
                }
            },

            async searchPropietario() {
                this.buscando_propietario = true

                this.axios
                    .get(`http://localhost:8000/api/persona/${this.propietario.identificacion}`)
                    .then(response => {

                        if( response.data.id > 0 ){
                            this.propietario = response.data
                            this.vehiculo.propietario_id = this.propietario.identificacion
                            this.registrar_propietario = false
                        }
                        else{
                            this.registrar_propietario = true
                        }
                    })
                    .catch(err => console.log(err))
                    .finally(() => this.buscando_propietario = false)
            },

            async searchModelos() {
                await this.axios
                .post('http://localhost:8000/api/modelos-by-marca', {marca_id: this.marca_id})
                .then(response => {
                    this.modelos = response.data;
                });
            }
        }
    }
</script>