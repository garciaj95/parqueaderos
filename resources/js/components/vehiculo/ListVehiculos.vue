<template>
    <div>
        <h2 class="text-center">Búsqueda de Vehículos</h2>
        <div class="row">
            <div class="col-md-12 text-right">
                <router-link :to="{name: 'vehiculo_create'}" class="nav-item nav-link">Nuevo Vehículo</router-link>
                <router-link :to="{name: 'lista_vehiculos_marca'}" class="nav-item nav-link">Vehículos por Marca</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form @submit.prevent="buscarVehiculo">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" v-model="busqueda.filtro" placeholder="Busca por Nombres, Identificacion, Placa de Vehiculo, Color">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" @click="buscarVehiculos()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-12 text-center" v-if="verificarListado">
                    <p>Se han encontrado {{ vehiculos.length }} Vehículos</p>
                </div>
            </div>
        </div>
        <div class="row" v-if="verificarListado">
            <div class="col-md-4" v-for="vehiculo in vehiculos" :key="vehiculo.id">
                <div class="card bg-light mb-3">
                    <div class="card-header">{{ vehiculo.desc_marca }} - {{ vehiculo.desc_modelo }}</div>
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ vehiculo.placa }}
                        </h5>
                        <ul>
                            <li>
                                <b>Propietario: </b> {{ vehiculo.nombres }}
                            </li>
                            <li>
                                <b>Tipo: </b> {{ vehiculo.tipo_desc }}
                            </li>
                            <li>
                                <b>Año: </b> {{ vehiculo.anio }}
                            </li>
                            <li>
                                <b>Color: </b> {{ vehiculo.color }}
                            </li>
                        </ul>
                        <small>
                            <b>Detalles: </b> {{ vehiculo.detalle }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                busqueda: {},
                vehiculos: [],
            }
        },
        computed: {
            verificarListado() {
                return this.vehiculos.length > 0
            }
        },
        created() {},
        methods: {
            buscarVehiculos() {
                this.axios
                    .post('http://localhost:8000/api/busca-vehiculos/', this.busqueda)
                    .then(response => {
                        this.vehiculos = response.data;
                    });
            }
        }
    }
</script>