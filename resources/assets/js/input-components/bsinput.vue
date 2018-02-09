<template>

    <div class="form-group" v-bind:class="{'text-danger has-error': error.length}">
        <label class="control-label" v-bind:for="id">{{ label }}</label>
        <input v-bind:type="type" v-bind:value="value" class="form-control form-control-sm" v-bind:class="inputClass" v-bind:id="id" v-on:input="updateModel($event.target.value)">
        <span v-show="error" class="help-block" style="">{{ error[0] }}</span>
    </div>


</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                default: ''
            },
            id: {
                type: String,
                default: ''
            },
            type: {
                type: String,
                default: 'text'
            },
            value: {
                type:'',
                default:''
            },
            'input-class':  {
                type: String,
                default: ''
            },
            error: {
                // type: Object,
                default: ''
            }
           
        },
        methods: {
            updateModel(value) {
                this.$emit('input', value)
            },
        }
    }
</script>