<script setup>
import { defineProps, ref } from "vue";
import ProductCard from "@/Components/ProductCard.vue";
import VueCarousel from "@/Components/VueCarousel.vue";

const openTab = ref(1);
const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <div class="max-w-7xl mx-auto mb-2">
    <div>
      <!-- Tab Buttons -->
      <div class="flex flex-row space-x-2 rounded-lg w-24 mb-1">
        <button
          @click="openTab = 1"
          :class="{ 'font-semibold': openTab === 1 }"
          class="flex-1 text-nowrap"
        >
          MSI GS Series
        </button>
        <button
          @click="openTab = 2"
          :class="{ 'font-semibold': openTab === 2 }"
          class="flex-1 text-nowrap"
        >
          MSI GT Series
        </button>
        <button
          @click="openTab = 3"
          :class="{ 'font-semibold': openTab === 3 }"
          class="flex-1 text-nowrap"
        >
          MSI GL Series
        </button>
      </div>

      <!-- Tab Content -->
      <div v-show="openTab === 1">
        <div class="flex flex-row">
          <div class="relative flex flex-col justify-center items-center mr-3">
            <img src="/images/msi-image.png" alt="picture" class="max-w-60 h-full" />
            <div
              class="absolute text-2xl text-white font-bold tracking-wider text-center"
            >
              <span class="block">Custom</span>
              <span class="block">Builds</span>
              <p
                class="absolute mt-20 text-xs text-nowrap capitalize underline text-white"
              >
                see all products
              </p>
            </div>
          </div>
          <div class="flex-1 overflow-hidden">
            <VueCarousel :products="products">
              <template #default="{ product }">
                <ProductCard :product="product" />
              </template>
            </VueCarousel>
          </div>
        </div>
      </div>

      <div v-show="openTab === 2">
        <div class="flex flex-row">
          <div class="relative flex flex-col justify-center items-center mr-3">
            <img src="/images/custom-build.png" alt="picture" class="max-w-60 h-full" />
            <div
              class="absolute text-2xl text-white font-bold tracking-wider text-center"
            >
              <span class="block">Custom</span>
              <span class="block">Builds</span>
              <p
                class="absolute mt-20 text-xs text-nowrap capitalize underline text-white"
              >
                see all products
              </p>
            </div>
          </div>
          <div class="flex-1 overflow-hidden">
            <VueCarousel :products="products">
              <template #default="{ product }">
                <ProductCard :product="product" />
              </template>
            </VueCarousel>
          </div>
        </div>
      </div>

      <div v-show="openTab === 3">
        <div class="flex flex-row">
          <div class="relative flex flex-col justify-center items-center mr-3">
            <img src="/images/custom-build.png" alt="picture" class="max-w-60 h-full" />
            <div
              class="absolute text-2xl text-white font-bold tracking-wider text-center"
            >
              <span class="block">Custom</span>
              <span class="block">Builds</span>
              <p
                class="absolute mt-20 text-xs text-nowrap capitalize underline text-white"
              >
                see all products
              </p>
            </div>
          </div>
          <div class="flex-1 overflow-hidden">
            <VueCarousel :products="products">
              <template #default="{ product }">
                <ProductCard :product="product" />
              </template>
            </VueCarousel>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
