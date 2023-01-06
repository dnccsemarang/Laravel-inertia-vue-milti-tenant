<script setup>
import { onMounted, ref, defineProps } from 'vue';

const props = defineProps({
    message: String
})

const showNotification = ref(false)

onMounted(() => {
    showNotification.value = true
    setTimeout(() => (showNotification.value = false), 2000)
})
</script>

<template>
    <div class="toast toast-top toast-end" v-if="message && showNotification">
        <div class="alert alert-success">
            <div>
                <span class="text-white">{{ message }}</span>
            </div>
        </div>
    </div>
</template>
