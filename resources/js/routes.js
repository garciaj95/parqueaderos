import ListMarcas from './components/marcas/ListMarcas.vue';
import CreateMarca from './components/marcas/CreateMarca.vue';
import EditMarca from './components/marcas/EditMarca.vue';

import ListModelos from './components/modelos/ListModelos.vue';
import CreateModelo from './components/modelos/CreateModelo.vue';
import EditModelo from './components/modelos/EditModelo.vue';

import ListTiposV from './components/tipo_vehiculo/ListTiposV.vue';
import CreateTipoV from './components/tipo_vehiculo/CreateTipoV.vue';
import EditTipoV from './components/tipo_vehiculo/EditTipoV.vue';
 
export const routes = [
    {
        name: 'marca_list',
        path: '/marcas',
        component: ListMarcas
    },
    {
        name: 'marca_create',
        path: '/marca/create',
        component: CreateMarca
    },
    {
        name: 'marca_edit',
        path: '/marcar/edit/:id',
        component: EditMarca
    },


    {
        name: 'modelo_list',
        path: '/modelos',
        component: ListModelos
    },
    {
        name: 'modelo_create',
        path: '/modelo/create',
        component: CreateModelo
    },
    {
        name: 'modelo_edit',
        path: '/modelo/edit/:id',
        component: EditModelo
    },

    {
        name: 'tipov_list',
        path: '/tipov',
        component: ListTiposV
    },
    {
        name: 'tipov_create',
        path: '/tipov/create',
        component: CreateTipoV
    },
    {
        name: 'tipov_edit',
        path: '/tipov/edit/:id',
        component: EditTipoV
    },
];