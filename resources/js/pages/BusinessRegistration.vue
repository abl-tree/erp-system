<template>
  <div class="container mx-auto p-4 my-10">
    <div class="flex flex-col gap-10">
        <div class="flex flex-row justify-between">
            <div class="text-4xl text-accent font-medium">Get Started!</div>
            <Logo />
        </div>

        <div class="flex flex-row gap-10">
            <StepNumber class="flex-none" number="1" />
            <div class="flex-1 flex flex-col gap-3">
                <div class="text-accent text-xl font-medium">Business Type</div>
                <div>1. Please select yout type of business.</div>
                <div class="w-full bg-white flex flex-wrap border border-gray-300 rounded-xl">
                    <div class="flex-none w-full border-b border-gray-300 rounded-t-md px-8 py-6">
                        <div class="flex flex-row items-center gap-3">
                            <MagnifyingGlassIcon  class="size-5 text-gray-400" />
                            <input name="business_type" type="text" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="flex-1 w-1/2 border-r border-gray-300 flex flex-col p-8 gap-5">
                        <div v-for="(option, key) in businessTypeOptions.slice(0, 7)" :key="key">
                            <input
                                :id="'option' + option.value"
                                class="peer hidden"
                                type="radio"
                                name="business_type"
                                :value="option.value"
                                v-model="selectedType"
                            />
                            <label :for="'option' + option.value" class="flex flex-row items-center justify-center gap-2 btn-secondary-transparent peer-checked:bg-secondary peer-checked:text-white py-2 px-5 w-fit">
                                <component :is="option.icon" class="w-4 h-4 flex-none" />
                                <span class="flex-1">{{ option.label }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="flex-1 w-1/2 flex flex-col p-8 gap-5">
                        <div v-for="(option, key) in businessTypeOptions.slice(7)" :key="key">
                            <input
                                :id="'option' + option.value"
                                class="peer hidden"
                                type="radio"
                                name="business_type"
                                :value="option.value"
                                v-model="selectedType"
                            />
                            <label :for="'option' + option.value" class="flex flex-row items-center justify-center gap-2 btn-secondary-transparent peer-checked:bg-secondary peer-checked:text-white py-2 px-5 w-fit">
                                <component :is="option.icon" class="w-4 h-4 flex-none" />
                                <span class="flex-1">{{ option.label }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 flex flex-col gap-3">
                <div class="flex-none h-[28px]"></div>
                <div>2. Choose the job roles in your company.</div>
                <div class="flex-grow w-full bg-white flex flex-col border border-gray-300 rounded-xl">
                    <div class="flex-none w-full border-b border-gray-300 px-8 py-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <div class="flex flex-wrap items-center gap-3">
                                <MagnifyingGlassIcon  class="size-5 text-gray-400" />
                                <input name="business_type" type="text" placeholder="Search..." />
                            </div>
                            <span v-for="(jobRole, key) in selectedJobRoles" class="flex flex-row px-5 py-2 rounded-xl text-accent font-medium text-sm bg-secondary bg-opacity-40 gap-2 items-center">
                                {{ jobRole.name }}
                                <button type="button" aria-label="Remove Job Role" title="Remove Job Role">
                                    <XMarkIcon class="size-3" />
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col p-8 gap-5 overflow-y-auto max-h-[400px]">
                        <div v-for="(jobRole, key) in jobRoles" :key="key" class="flex flex-col gap-2 py-3 px-5 border-b">
                            <div class="flex flex-row">
                                <div class="flex-grow flex items-center font-bold">
                                {{ jobRole.name }}
                                </div>
                                <div class="flex-none flex flex-row gap-5 items-center">
                                    <input type="checkbox" class="hidden" v-model="selectedJobRoles" :value="jobRole" :id="'item' + jobRole.id">
                                    <label :for="'item' + jobRole.id" class="rounded-xl bg-gray-400 px-8 py-1 text-white btn-secondary-transparent">Add</label>
                                    <ChevronDownIcon  class="size-5 text-secondary" />
                                </div>
                            </div>
                            <div>{{ jobRole.description }}</div>
                        </div>
                    </div>
                    <div class="flex-none">
                    1
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex flex-row gap-10">
            <StepNumber class="flex-none" number="2" />
            <div class="flex-1 flex flex-col gap-3">
                <div class="text-accent text-xl font-medium">Location</div>
                <div>Select your business location.</div>                
                <div class="w-full bg-white flex flex-row border border-gray-300 rounded-xl px-8 py-6 gap-10 items-center">
                    <div>{{ selectedCountry?.name ?? 'Country' }}</div>
                    <div><ChevronRightIcon class="size-5 text-gray-500" /></div>
                    <div>{{ selectedState?.name ?? 'State' }}</div>
                </div>
                <div class="w-full bg-white flex flex-wrap border border-gray-300 rounded-xl">
                    <div class="flex-none w-full border-b border-gray-300 rounded-t-md px-8 py-6">
                        <div class="flex flex-row items-center gap-3">
                            <MagnifyingGlassIcon  class="size-5 text-gray-400" />
                            <input name="country" type="text" placeholder="Search..." v-model="countrySearch" />
                        </div>
                    </div>
                    <div class="flex-1 w-1/2 border-r border-gray-300 flex flex-col">
                        <div class="flex-none px-8 py-5 border-b border-gray-300 text-secondary">Country</div>
                        <div class="px-3 py-2 h-[400px] overflow-y-auto">
                            <label v-for="(country, key) in countries" :key="key" :class="{'bg-secondary !text-white': (selectedCountry === country)}" class="flex flex-row items-center justify-center gap-2 group hover:bg-secondary hover:!text-white rounded-2xl py-2 px-5 w-full cursor-pointer">
                                <input
                                    class="group peer hidden"
                                    type="radio"
                                    name="country"
                                    :value="country"
                                    v-model="selectedCountry"
                                />
                                <span class="flex-1 text-left">{{ country.name }}</span>
                                <ChevronRightIcon class="size-5 text-gray-400 group-hover:text-white peer-checked:text-white" />
                            </label>
                        </div>
                    </div>
                    <div class="flex-1 w-1/2 flex flex-col">
                        <div class="flex-none px-8 py-5 border-b border-gray-300 text-secondary">Province/State</div>
                        <div class="px-3 py-2 h-[400px] overflow-y-auto">
                            <label v-for="(state, key) in states" :key="key" :class="{'bg-secondary !text-white': (selectedState === state)}" class="flex flex-row items-center justify-center gap-2 group hover:bg-secondary hover:!text-white rounded-2xl py-2 px-5 w-full">
                                <input
                                    class="peer hidden"
                                    type="radio"
                                    name="state"
                                    :value="state"
                                    v-model="selectedState"
                                />
                                <span class="flex-1 text-left">{{ state.name }} </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row gap-10">
            <StepNumber class="flex-none" number="3" />
            <div class="flex-1 flex flex-col gap-3">
                <div class="text-accent text-xl font-medium">Features</div>
                <div>Choose from the available list of features.</div>
                <div class="flex-grow w-full bg-white flex flex-col border border-gray-300 rounded-xl">
                    <div class="flex-none w-full border-b border-gray-300 px-8 py-6">
                        <div class="flex flex-wrap items-center gap-2">
                            <div class="flex flex-wrap items-center gap-3">
                                <MagnifyingGlassIcon  class="size-5 text-gray-400" />
                                <input name="business_type" type="text" placeholder="Search..." />
                            </div>
                            <span class="flex flex-row px-5 py-2 rounded-xl text-accent font-medium text-sm bg-secondary bg-opacity-40 gap-2 items-center">
                                Practical Troubleshooter 
                                <button type="button" aria-label="Remove Job Role" title="Remove Job Role">
                                    <XMarkIcon class="size-3" />
                                </button>
                            </span>
                            <span class="flex flex-row px-5 py-2 rounded-xl text-accent font-medium text-sm bg-secondary bg-opacity-40 gap-2 items-center">
                                Reliable Fixer 
                                <button type="button" aria-label="Remove Job Role" title="Remove Job Role">
                                    <XMarkIcon class="size-3" />
                                </button>
                            </span>
                            <span class="flex flex-row px-5 py-2 rounded-xl text-accent font-medium text-sm bg-secondary bg-opacity-40 gap-2 items-center">
                                Skilled Technician 
                                <button type="button" aria-label="Remove Job Role" title="Remove Job Role">
                                    <XMarkIcon class="size-3" />
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col p-8 gap-5 overflow-y-auto max-h-[400px]">
                        <div class="flex flex-col gap-2 py-3 px-5 border-b">
                            <div class="flex flex-row">
                                <div class="flex-grow flex items-center font-bold">Practical Troubleshooter</div>
                                <div class="flex-none flex flex-row gap-5 items-center">
                                    <button type="button" class="rounded-xl bg-gray-400 px-8 py-1 text-white">Add</button>
                                    <ChevronDownIcon  class="size-5 text-secondary" />
                                </div>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero.</div>
                        </div>
                        <div class="flex flex-col gap-2 py-3 px-5 border-b">
                            <div class="flex flex-row">
                                <div class="flex-grow flex items-center font-bold">Practical Troubleshooter</div>
                                <div class="flex-none flex flex-row gap-5 items-center">
                                    <button type="button" class="rounded-xl bg-gray-400 px-8 py-1 text-white">Add</button>
                                    <ChevronDownIcon  class="size-5 text-secondary" />
                                </div>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero.</div>
                        </div>
                        <div class="flex flex-col gap-2 py-3 px-5 border-b">
                            <div class="flex flex-row">
                                <div class="flex-grow flex items-center font-bold">Practical Troubleshooter</div>
                                <div class="flex-none flex flex-row gap-5 items-center">
                                    <button type="button" class="rounded-xl bg-gray-400 px-8 py-1 text-white">Add</button>
                                    <ChevronDownIcon  class="size-5 text-secondary" />
                                </div>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero.</div>
                        </div>
                        <div class="flex flex-col gap-2 py-3 px-5 border-b">
                            <div class="flex flex-row">
                                <div class="flex-grow flex items-center font-bold">Practical Troubleshooter</div>
                                <div class="flex-none flex flex-row gap-5 items-center">
                                    <button type="button" class="rounded-xl bg-gray-400 px-8 py-1 text-white">Add</button>
                                    <ChevronDownIcon  class="size-5 text-secondary" />
                                </div>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero.</div>
                        </div>
                        <div class="flex flex-col gap-2 py-3 px-5 border-b">
                            <div class="flex flex-row">
                                <div class="flex-grow flex items-center font-bold">Practical Troubleshooter</div>
                                <div class="flex-none flex flex-row gap-5 items-center">
                                    <button type="button" class="rounded-xl bg-gray-400 px-8 py-1 text-white">Add</button>
                                    <ChevronDownIcon  class="size-5 text-secondary" />
                                </div>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-row gap-10">
            <StepNumber class="flex-none" number="4" />
            <div class="flex-1 flex flex-col gap-3">
                <div class="text-accent text-xl font-medium">Customize</div>
                <div>Make your custom URL for your business.</div>
                <div class="flex-grow w-full flex flex-col gap-5">
                    <div class="flex-none w-full px-8 py-4 rounded-xl bg-white border border-gray-300">
                        <input class="w-full" name="custom_url" type="text" placeholder="enterpriseopt.com/business.name" />
                    </div>
                    <div class="flex-none w-full">
                        <button class="bg-secondary w-full p-4 text-white rounded-xl font-semibold" @click="handleSubmit">Finish</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import Logo from '@/components/Logo.vue';
import SolidFireworks from '@/assets/solid-fireworks.svg';
import BalloonIcon from '@/assets/icons/balloon-sharp.svg';
import BeautySalonIcon from '@/assets/icons/beauty-salon.svg';
import CameraIcon from '@/assets/icons/camera-filled.svg';
import CleanHandsIcon from '@/assets/icons/clean-hands-sharp.svg';
import HouseIcon from '@/assets/icons/house-fill.svg';
import LandscapeIcon from '@/assets/icons/landscape.svg';
import LegalIcon from '@/assets/icons/legal.svg';
import MapIcon from '@/assets/icons/map.svg';
import MoneyBagIcon from '@/assets/icons/money-bag-bold.svg';
import ShipIcon from '@/assets/icons/ship.svg';
import ToolIcon from '@/assets/icons/tool-fill.svg';
import TruckIcon from '@/assets/icons/truck-fill.svg';
import CleaningServicesIcon from '@/assets/icons/cleaning-services.svg';
import { MagnifyingGlassIcon, ChevronRightIcon, ChevronDownIcon, XMarkIcon } from '@heroicons/vue/24/solid'
import StepNumber from '@/components/StepNumber.vue';
import CountryCityStateJson from 'countrycitystatejson';

const countryItems = CountryCityStateJson.getCountries();
countryItems.sort((a, b) => a.name.localeCompare(b.name));
const countries = ref([]);
const states = ref({});
const selectedCountry = ref(null);
const selectedState = ref(null);
const selectedType = ref(null);
const selectedJobRoles = ref([]);
const countrySearch = ref('');
const jobRoles = [
    { id: 1, name: 'Practical Troubleshooter', description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus posuere augue, gravida lobortis libero.' },
    { id: 2, name: 'Reliable Fixer', description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus pos uere augue, gravida lobortis libero.' },
    { id: 3, name: 'Skilled Technician', description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae massa neque. Aenean dapibus pos uere augue, gravida lobortis libero.' }
]
const businessTypeOptions = [
    { value: 'beauty_salon', label: 'Beauty Salons', icon: BeautySalonIcon },
    { value: 'cleaning_business', label: 'Cleaning Business', icon: CleanHandsIcon },
    { value: 'event_coordinators', label: 'Event Coordinators', icon: BalloonIcon },
    { value: 'tour_guide', label: 'Tour Guide', icon: MapIcon },
    { value: 'janitorial_services', label: 'Janitorial Services', icon: CleaningServicesIcon },
    { value: 'landscaping', label: 'Landscaping', icon: LandscapeIcon },
    { value: 'legal_services', label: 'Legal services', icon: LegalIcon },
    { value: 'moving_company', label: 'Moving Company', icon: TruckIcon },
    { value: 'photography', label: 'Photography', icon: CameraIcon },
    { value: 'property_managers', label: 'Property Managers', icon: HouseIcon },
    { value: 'repairmen', label: 'Repairmen', icon: ToolIcon },
    { value: 'shipping_freight', label: 'Shipping/Freight', icon: ShipIcon },
    { value: 'financial_services', label: 'Financial Services Consulting', icon: MoneyBagIcon }
]

const getCountries = async () => {
    const cacheKey = 'countries';
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData) {
        cachedData = JSON.parse(cachedData);
    } else {
        // If data does not exist in cache, fetch and cache it
        const results = await axios.get('api/v1/address/countries');
        cachedData = results.data.countries;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    countries.value = cachedData;
}

getCountries();

const getStates = async (iso2) => {
    const cacheKey = 'states-' + iso2;
    let cachedData = localStorage.getItem(cacheKey);    

    if (cachedData) {
        cachedData = JSON.parse(cachedData);
    } else {
        const results = await axios.get('api/v1/address/states', {
            params: {
                'iso2': iso2
            }
        })
        cachedData = results.data.states;
        localStorage.setItem(cacheKey, JSON.stringify(cachedData));
    }
    
    return cachedData;
}

const handleSubmit = () => {
    console.log('Submit', selectedJobRoles.value);
}

watch(selectedCountry, async (newValue, oldValue) => {
    selectedState.value = null;    
    states.value = await getStates(newValue.iso2);
});

watch(countrySearch, (newValue, oldValue) => {
    if (!newValue) {
        // If search query is empty, return all items
        countries.value = countryItems;
    } else {
        // Filter items based on search query (case-insensitive)
        countries.value = countryItems.filter((item) =>
            item.name.toLowerCase().includes(newValue.toLowerCase())
        );
    }
});
    
</script>