<template>
    <div>
        <h1 class="font-medium  text-gray-600">
            أنشاء ال QRCode الخاص بيك
        </h1>

        <div class="p-5 shadow rounded">
            <div class="flex flex-wrap items-center justify-center" v-if="user.menu">
                <div >
                    <div ref="canvas"></div>
                </div>
                <div class="flex  flex-wrap gap-2 py-4 w-full items-center justify-center">
                    <div class="min-w-fit">
                        <input @change="onChangeFile" ref="file" hidden type="file" accept="image/png, image/jpeg">
                        <button @click="$refs.file.click()" class="border px-4 py-1.5 rounded-lg active:bg-gray-700  bg-gray-800 hover:ring-2 hover:ring-gray-900 text-white">
                            تغير الصوره
                        </button>
                    </div>
                    <div class="min-w-fit">
                        <input ref="bg" @change="onChangeBackground" type="color" />
                        <!-- <button @click="$refs.bg.click()" class="border px-4 py-1.5 rounded-lg active:bg-gray-700  bg-gray-800 hover:ring-2 hover:ring-gray-900 text-white">
                            تغير لون الخلفية
                        </button> -->
                    </div>
                    <div class="min-w-fit">
                        <input ref="color" @change="onChangeColor"  type="color" />
                        <!-- <button @click="$refs.color.click()" class="border px-4 py-1.5 rounded-lg active:bg-gray-700  bg-gray-800 hover:ring-2 hover:ring-gray-900 text-white">
                            تغير لون الخطوط
                        </button> -->
                    </div>
                </div>
                <div>
                    <button @click="downloadQRCode" class="border px-4 py-1.5 rounded-lg active:bg-gray-700  bg-gray-800 hover:ring-2 hover:ring-gray-900 text-white">
                        تنزيل الـ QRCode
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="text-center">
                    <h1 class="text-gray-600">
                        لاتوجد بيانات
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup>
import { ref, onMounted, defineProps } from "vue"
import QRCodeStyling from "qr-code-styling";


const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
})


const canvas = ref(null)
const qrCode = new QRCodeStyling({
    type: "svg",
    data: "https://www.facebook.com/",
    image: "/favicon.png",
    qrOptions:{
        errorCorrectionLevel: "H",
    },
    dotsOptions: {
        color: "#4267b2",
        type: "classy"
    },
    backgroundOptions: {
        color: "#fff",
    },
    imageOptions: {
        crossOrigin: "extra-rounded",
        margin: 5
    },
    cornersSquareOptions:{
        type: "extra-rounded"
    },
    cornersDotOptions: {
        type: "dot"
    }
});

const onChangeFile = ($event)=>{
    const blobURL = URL.createObjectURL($event.target.files[0])
    qrCode.update({image:blobURL}) 
}

const onChangeBackground = ($event)=> {
    qrCode.update({backgroundOptions: {color: $event.target.value}})
}

const onChangeColor = ($event)=> {
    qrCode.update({dotsOptions: {color: $event.target.value}})
}

const downloadQRCode = () =>{
    qrCode.download({ name: "qrcode", extension: "jpeg" });
    qrCode.download({ name: "qrcode", extension: "svg" });
}

onMounted(()=> {
    let url = `${import.meta.env.VITE_DOWEN}/${props.user.menu.title_slug}`
    qrCode.update({data: url})
    qrCode.append(canvas.value)
})

</script>