<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Process Payroll Run - Monti Textile HRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */@layer theme,:root,:host{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";--font-serif:ui-serif,Georgia,Cambria,"Times New Roman",Times,serif;--font-mono:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier Newemonospace";--color-red-50:oklch(.971 .013 17.38);--color-red-100:oklch(.936 .032 17.717);--color-red-200:oklch(.885 .062 18.334);--color-red-300:oklch(.808 .114 19.571);--color-red-400:oklch(.704 .191 22.216);--color-red-500:oklch(.637 .237 25.331);--color-red-600:oklch(.577 .245 27.325);--color-red-700:oklch(.505 .213 27.518);--color-red-800:oklch(.444 .177 26.899);--color-red-900:oklch(.396 .141 25.723);--color-red-950:oklch(.258 .092 26.042);--color-orange-50:oklch(.98 .016 73.684);--color-orange-100:oklch(.954 .038 75.164);--color-orange-200:oklch(.901 .076 70.697);--color-orange-300:oklch(.837 .128 66.29);--color-orange-400:oklch(.75 .183 55.934);--color-orange-500:oklch(.705 .213 47.604);--color-orange-600:oklch(.646 .222 41.116);--color-orange-700:oklch(.553 .195 38.402);--color-orange-800:oklch(.47 .157 37.304);--color-orange-900:oklch(.408 .123 38.172);--color-orange-950:oklch(.266 .079 36.259);--color-amber-50:oklch(.987 .022 95.277);--color-amber-100:oklch(.962 .059 95.617);--color-amber-200:oklch(.924 .12 95.746);--color-amber-300:oklch(.879 .169 91.605);--color-amber-400:oklch(.828 .189 84.429);--color-amber-500:oklch(.769 .188 70.08);--color-amber-600:oklch(.666 .179 58.318);--color-amber-700:oklch(.555 .163 48.998);--color-amber-800:oklch(.473 .137 46.201);--color-amber-900:oklch(.414 .112 45.904);--color-amber-950:oklch(.279 .077 45.635);--color-yellow-50:oklch(.987 .026 102.212);--color-yellow-100:oklch(.973 .071 103.193);--color-yellow-200:oklch(.945 .129 101.54);--color-yellow-300:oklch(.905 .182 98.111);--color-yellow-400:oklch(.852 .199 91.936);--color-yellow-500:oklch(.795 .184 86.047);--color-yellow-600:oklch(.681 .162 75.834);--color-yellow-700:oklch(.554 .135 66.442);--color-yellow-800:oklch(.476 .114 61.907);--color-yellow-900:oklch(.421 .095 57.708);--color-yellow-950:oklch(.286 .066 53.813);--color-lime-50:oklch(.986 .031 120.757);--color-lime-100:oklch(.967 .067 122.328);--color-lime-200:oklch(.938 .127 124.321);--color-lime-300:oklch(.897 .196 126.665);--color-lime-400:oklch(.841 .238 128.85);--color-lime-500:oklch(.768 .233 130.85);--color-lime-600:oklch(.648 .2 131.684);--color-lime-700:oklch(.532 .157 131.589);--color-lime-800:oklch(.453 .124 130.933);--color-lime-900:oklch(.405 .101 131.063);--color-lime-950:oklch(.274 .072 132.109);--color-green-50:oklch(.982 .018 155.826);--color-green-100:oklch(.962 .044 156.743);--color-green-200:oklch(.925 .084 155.995);--color-green-300:oklch(.871 .15 154.449);--color-green-400:oklch(.792 .209 151.711);--color-green-500:oklch(.723 .219 149.579);--color-green-600:oklch(.627 .194 149.214);--color-green-700:oklch(.527 .154 150.069);--color-green-800:oklch(.448 .119 151.328);--color-green-900:oklch(.393 .095 152.535);--color-green-950:oklch(.266 .065 152.934);--color-emerald-50:oklch(.979 .021 166.113);--color-emerald-100:oklch(.95 .052 163.051);--color-emerald-200:oklch(.905 .093 164.15);--color-emerald-300:oklch(.845 .143 164.978);--color-emerald-400:oklch(.765 .177 163.223);--color-emerald-500:oklch(.696 .17 162.48);--color-emerald-600:oklch(.596 .145 163.225);--color-emerald-700:oklch(.508 .118 165.612);--color-emerald-800:oklch(.432 .095 166.913);--color-emerald-900:oklch(.378 .077 168.94);--color-emerald-950:oklch(.262 .051 172.552);--color-teal-50:oklch(.984 .014 180.72);--color-teal-100:oklch(.953 .051 180.801);--color-teal-200:oklch(.91 .096 180.426);--color-teal-300:oklch(.855 .138 181.071);--color-teal-400:oklch(.777 .152 181.912);--color-teal-500:oklch(.704 .14 182.503);--color-teal-600:oklch(.6 .118 184.704);--color-teal-700:oklch(.511 .096 186.391);--color-teal-800:oklch(.437 .078 188.216);--color-teal-900:oklch(.386 .063 188.416);--color-teal-950:oklch(.277 .046 192.524);--color-cyan-50:oklch(.984 .019 200.873);--color-cyan-100:oklch(.956 .045 203.388);--color-cyan-200:oklch(.917 .08 205.041);--color-cyan-300:oklch(.865 .127 207.078);--color-cyan-400:oklch(.789 .154 211.53);--color-cyan-500:oklch(.715 .143 215.221);--color-cyan-600:oklch(.609 .126 221.723);--color-cyan-700:oklch(.52 .105 223.128);--color-cyan-800:oklch(.45 .085 224.283);--color-cyan-900:oklch(.398 .07 227.392);--color-cyan-950:oklch(.302 .056 229.695);--color-sky-50:oklch(.977 .013 236.62);--color-sky-100:oklch(.951 .026 236.824);--color-sky-200:oklch(.901 .058 230.902);--color-sky-300:oklch(.828 .111 230.318);--color-sky-400:oklch(.746 .16 232.661);--color-sky-500:oklch(.685 .169 237.323);--color-sky-600:oklch(.588 .158 241.966);--color-sky-700:oklch(.5 .134 242.749);--color-sky-800:oklch(.443 .11 240.79);--color-sky-900:oklch(.391 .09 240.876);--color-sky-950:oklch(.293 .066 243.157);--color-blue-50:oklch(.97 .014 254.604);--color-blue-100:oklch(.932 .032 255.585);--color-blue-200:oklch(.882 .059 254.128);--color-blue-300:oklch(.809 .105 251.813);--color-blue-400:oklch(.707 .165 254.624);--color-blue-500:oklch(.623 .214 259.815);--color-blue-600:oklch(.546 .245 262.881);--color-blue-700:oklch(.488 .243 264.376);--color-blue-800:oklch(.424 .199 265.638);--color-blue-900:oklch(.379 .146 265.522);--color-blue-950:oklch(.282 .091 267.935);--color-indigo-50:oklch(.962 .018 272.314);--color-indigo-100:oklch(.93 .034 272.788);--color-indigo-200:oklch(.87 .065 274.039);--color-indigo-300:oklch(.785 .115 274.713);--color-indigo-400:oklch(.673 .182 276.935);--color-indigo-500:oklch(.585 .233 277.117);--color-indigo-600:oklch(.511 .262 276.966);--color-indigo-700:oklch(.457 .24 277.023);--color-indigo-800:oklch(.398 .195 277.366);--color-indigo-900:oklch(.359 .144 278.697);--color-indigo-950:oklch(.257 .09 281.288);--color-violet-50:oklch(.969 .016 293.756);--color-violet-100:oklch(.943 .029 294.588);--color-violet-200:oklch(.894 .057 293.283);--color-violet-300:oklch(.811 .111 293.571);--color-violet-400:oklch(.702 .183 293.541);--color-violet-500:oklch(.606 .25 292.717);--color-violet-600:oklch(.541 .281 293.009);--color-violet-700:oklch(.491 .27 292.581);--color-violet-800:oklch(.432 .232 292.759);--color-violet-900:oklch(.38 .189 293.745);--color-violet-950:oklch(.283 .141 291.089);--color-purple-50:oklch(.977 .014 308.299);--color-purple-100:oklch(.946 .033 307.174);--color-purple-200:oklch(.902 .063 306.703);--color-purple-300:oklch(.827 .119 306.383);--color-purple-400:oklch(.714 .203 305.504);--color-purple-500:oklch(.627 .265 303.9);--color-purple-600:oklch(.558 .288 302.321);--color-purple-700:oklch(.496 .265 301.924);--color-purple-800:oklch(.438 .218 303.724);--color-purple-900:oklch(.381 .176 304.987);--color-purple-950:oklch(.291 .149 302.717);--color-fuchsia-50:oklch(.977 .017 320.058);--color-fuchsia-100:oklch(.952 .037 318.852);--color-fuchsia-200:oklch(.903 .076 319.62);--color-fuchsia-300:oklch(.833 .145 321.434);--color-fuchsia-400:oklch(.74 .238 322.16);--color-fuchsia-500:oklch(.667 .295 322.15);--color-fuchsia-600:oklch(.591 .293 322.896);--color-fuchsia-700:oklch(.518 .253 323.949);--color-fuchsia-800:oklch(.452 .211 324.591);--color-fuchsia-900:oklch(.401 .17 325.612);--color-fuchsia-950:oklch(.293 .136 325.661);--color-pink-50:oklch(.971 .014 343.198);--color-pink-100:oklch(.948 .028 342.258);--color-pink-200:oklch(.899 .061 343.231);--color-pink-300:oklch(.823 .12 346.018);--color-pink-400:oklch(.718 .202 349.761);--color-pink-500:oklch(.656 .241 354.308);--color-pink-600:oklch(.592 .249 .584);--color-pink-700:oklch(.525 .223 3.958);--color-pink-800:oklch(.459 .187 3.815);--color-pink-900:oklch(.408 .153 2.432);--color-pink-950:oklch(.284 .109 3.907);--color-rose-50:oklch(.969 .015 12.422);--color-rose-100:oklch(.941 .03 12.58);--color-rose-200:oklch(.892 .058 10.001);--color-rose-300:oklch(.81 .117 11.638);--color-rose-400:oklch(.712 .194 13.428);--color-rose-500:oklch(.645 .246 16.439);--color-rose-600:oklch(.586 .253 17.585);--color-rose-700:oklch(.514 .222 16.935);--color-rose-800:oklch(.455 .188 13.697);--color-rose-900:oklch(.41 .159 10.272);--color-rose-950:oklch(.271 .105 12.094);--color-slate-50:oklch(.984 .003 247.858);--color-slate-100:oklch(.968 .007 247.896);--color-slate-200:oklch(.929 .013 255.508);--color-slate-300:oklch(.869 .022 252.894);--color-slate-400:oklch(.704 .04 256.788);--color-slate-500:oklch(.554 .046 257.417);--color-slate-600:oklch(.446 .043 257.281);--color-slate-700:oklch(.372 .044 257.287);--color-slate-800:oklch(.279 .041 260.031);--color-slate-900:oklch(.208 .042 265.755);--color-slate-950:oklch(.129 .042 264.695);--color-gray-50:oklch(.985 .002 247.839);--color-gray-100:oklch(.967 .003 264.542);--color-gray-200:oklch(.928 .006 264.531);--color-gray-300:oklch(.872 .01 258.338);--color-gray-400:oklch(.707 .022 261.325);--color-gray-500:oklch(.551 .027 264.364);--color-gray-600:oklch(.446 .03 256.802);--color-gray-700:oklch(.373 .034 259.733);--color-gray-800:oklch(.278 .033 256.848);--color-gray-900:oklch(.21 .034 264.665);--color-gray-950:oklch(.13 .028 261.692);--color-zinc-50:oklch(.985 0 0);--color-zinc-100:oklch(.967 .001 286.375);--color-zinc-200:oklch(.92 .004 286.32);--color-zinc-300:oklch(.871 .006 286.286);--color-zinc-400:oklch(.705 .015 286.067);--color-zinc-500:oklch(.552 .016 285.938);--color-zinc-600:oklch(.442 .017 285.786);--color-zinc-700:oklch(.37 .013 285.805);--color-zinc-800:oklch(.274 .006 286.033);--color-zinc-900:oklch(.21 .006 285.885);--color-zinc-950:oklch(.141 .005 285.823);--color-neutral-50:oklch(.985 0 0);--color-neutral-100:oklch(.97 0 0);--color-neutral-200:oklch(.922 0 0);--color-neutral-300:oklch(.87 0 0);--color-neutral-400:oklch(.708 0 0);--color-neutral-500:oklch(.556 0 0);--color-neutral-600:oklch(.439 0 0);--color-neutral-700:oklch(.371 0 0);--color-neutral-800:oklch(.269 0 0);--color-neutral-900:oklch(.205 0 0);--color-neutral-950:oklch(.145 0 0);--color-stone-50:oklch(.985 .001 106.423);--color-stone-100:oklch(.97 .001 106.424);--color-stone-200:oklch(.923 .003 48.717);--color-stone-300:oklch(.869 .005 56.366);--color-stone-400:oklch(.709 .01 56.259);--color-stone-500:oklch(.553 .013 58.071);--color-stone-600:oklch(.444 .011 73.639);--color-stone-700:oklch(.374 .01 67.558);--color-stone-800:oklch(.268 .007 34.298);--color-stone-900:oklch(.216 .006 56.043);--color-stone-950:oklch(.147 .004 49.25);--color-black:#000;--color-white:#fff;--spacing:.25rem;--breakpoint-sm:40rem;--breakpoint-md:48rem;--breakpoint-lg:64rem;--breakpoint-xl:80rem;--breakpoint-2xl:96rem;--container-3xs:16rem;--container-2xs:18rem;--container-xs:20rem;--container-sm:24rem;--container-md:28rem;--container-lg:32rem;--container-xl:36rem;--container-2xl:42rem;--container-3xl:48rem;--container-4xl:56rem;--container-5xl:64rem;--container-6xl:72rem;--container-7xl:80rem;--text-xs:.75rem;--text-xs--line-height:calc(1/.75);--text-sm:.875rem;--text-sm--line-height:calc(1.25/.875);--text-base:1rem;--text-base--line-height: 1.5 ;--text-lg:1.125rem;--text-lg--line-height:calc(1.75/1.125);--text-xl:1.25rem;--text-xl--line-height:calc(1.75/1.25);--text-2xl:1.5rem;--text-2xl--line-height:calc(2/1.5);--text-3xl:1.875rem;--text-3xl--line-height: 1.2 ;--text-4xl:2.25rem;--text-4xl--line-height:calc(2.5/2.25);--text-5xl:3rem;--text-5xl--line-height:1;--text-6xl:3.75rem;--text-6xl--line-height:1;--text-7xl:4.5rem;--text-7xl--line-height:1;--text-8xl:6rem;--text-8xl--line-height:1;--text-9xl:8rem;--text-9xl--line-height:1;--font-weight-thin:100;--font-weight-extralight:200;--font-weight-light:300;--font-weight-normal:400;--font-weight-medium:500;--font-weight-semibold:600;--font-weight-bold:700;--font-weight-extrabold:800;--font-weight-black:900;--tracking-tighter:-.05em;--tracking-tight:-.025em;--tracking-normal:0em;--tracking-wide:.025em;--tracking-wider:.05em;--tracking-widest:.1em;--leading-tight:1.25;--leading-snug:1.375;--leading-normal:1.5;--leading-relaxed:1.625;--leading-loose:2;--radius-xs:.125rem;--radius-sm:.25rem;--radius-md:.375rem;--radius-lg:.5rem;--radius-xl:.75rem;--radius-2xl:1rem;--radius-3xl:1.5rem;--radius-4xl:2rem;--shadow-2xs:0 1px #0000000d;--shadow-xs:0 1px 2px 0 #0000000d;--shadow-sm:0 1px 3px 0 #0000001a,0 1px 2px -1px #0000001a;--shadow-md:0 4px 6px -1px #0000001a,0 2px 4px -2px #0000001a;--shadow-lg:0 10px 15px -3px #0000001a,0 4px 6px -4px #0000001a;--shadow-xl:0 20px 25px -5px #0000001a,0 8px 10px -6px #0000001a;--shadow-2xl:0 25px 50px -12px #00000040;--inset-shadow-2xs:inset 0 1px #0000000d;--inset-shadow-xs:inset 0 1px 1px #0000000d;--inset-shadow-sm:inset 0 2px 4px #0000000d;--drop-shadow-xs:0 1px 1px #0000000d;--drop-shadow-sm:0 1px 2px #00000026;--drop-shadow-md:0 3px 3px #0000001f;--drop-shadow-lg:0 4px 4px #00000026;--drop-shadow-xl:0 9px 7px #0000001a;--drop-shadow-2xl:0 25px 25px #00000026;--ease-in:cubic-bezier(.4,0,1,1);--ease-out:cubic-bezier(0,0,.2,1);--ease-in-out:cubic-bezier(.4,0,.2,1);--animate-spin:spin 1s linear infinite;--animate-ping:ping 1s cubic-bezier(0,0,.2,1)infinite;--animate-pulse:pulse 2s cubic-bezier(.4,0,.6,1)infinite;--animate-bounce:bounce 1s infinite;--blur-xs:4px;--blur-sm:8px;--blur-md:12px;--blur-lg:16px;--blur-xl:24px;--blur-2xl:40px;--blur-3xl:64px;--perspective-dramatic:100px;--perspective-near:300px;--perspective-normal:500px;--perspective-midrange:800px;--perspective-distant:1200px;--aspect-video:16/9;--default-transition-duration:.15s;--default-transition-timing-function:cubic-bezier(.4,0,.2,1);--default-font-family:var(--font-sans);--default-font-feature-settings:var(--font-sans--font-feature-settings);--default-font-variation-settings:var(--font-sans--font-variation-settings);--default-mono-font-family:var(--font-mono);--default-mono-font-feature-settings:var(--font-mono--font-feature-settings);--default-mono-font-variation-settings:var(--font-mono--font-variation-settings)}}@layer base{*,:after,:before,::backdrop{box-sizing:border-box;border:0 solid;margin:0;padding:0}::file-selector-button{box-sizing:border-box;border:0 solid;margin:0;padding:0}html,:host{-webkit-text-size-adjust:100%;-moz-tab-size:4;tab-size:4;line-height:1.5;font-family:var(--default-font-family,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji");font-feature-settings:var(--default-font-feature-settings,normal);font-variation-settings:var(--default-font-variation-settings,normal);-webkit-tap-highlight-color:transparent}body{line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;-webkit-text-decoration:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:var(--default-mono-font-family,ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier Newmonospace");font-feature-settings:var(--default-mono-font-feature-settings,normal);font-variation-settings:var(--default-mono-font-variation-settings,normal);font-size:1em}small{font-size:80%}sub,sup{vertical-align:baseline;font-size:75%;line-height:0;position:relative}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}:-moz-focusring{outline:auto}progress{vertical-align:baseline}summary{display:list-item}ol,ul,menu{list-style:none}img,svg,video,canvas,audio,iframe,embed,object{vertical-align:middle;display:block}img,video{max-width:100%;height:auto}button,input,select,optgroup,textarea{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}::file-selector-button{font:inherit;font-feature-settings:inherit;font-variation-settings:inherit;letter-spacing:inherit;color:inherit;opacity:1;background-color:#0000;border-radius:0}:where(select:is([multiple],[size])) optgroup{font-weight:bolder}:where(select:is([multiple],[size])) optgroup option{padding-inline-start:20px}::file-selector-button{margin-inline-end:4px}::placeholder{opacity:1;color:color-mix(in oklab,currentColor 50%,transparent)}textarea{resize:vertical}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-date-and-time-value{min-height:1lh;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-datetime-edit{padding-block:0}::-webkit-datetime-edit-year-field{padding-block:0}::-webkit-datetime-edit-month-field{padding-block:0}::-webkit-datetime-edit-day-field{padding-block:0}::-webkit-datetime-edit-hour-field{padding-block:0}::-webkit-datetime-edit-minute-field{padding-block:0}::-webkit-datetime-edit-second-field{padding-block:0}::-webkit-datetime-edit-millisecond-field{padding-block:0}::-webkit-datetime-edit-meridiem-field{padding-block:0}:-moz-ui-invalid{box-shadow:none}button,input:where([type=button],[type=reset],[type=submit]){-webkit-appearance:button;-moz-appearance:button;appearance:button}::file-selector-button{-webkit-appearance:button;-moz-appearance:button;appearance:button}::-webkit-inner-spin-button{height:auto}::-webkit-outer-spin-button{height:auto}[hidden]:where(:not([hidden=until-found])){display:none!important}}@layer components;@layer utilities{.absolute{position:absolute}.relative{position:relative}.static{position:static}.inset-0{inset:calc(var(--spacing)*0)}.-mt-\[4\.9rem\]{margin-top:-4.9rem}.-mb-px{margin-bottom:-1px}.mb-1{margin-bottom:calc(var(--spacing)*1)}.mb-2{margin-bottom:calc(var(--spacing)*2)}.mb-4{margin-bottom:calc(var(--spacing)*4)}.mb-6{margin-bottom:calc(var(--spacing)*6)}.-ml-8{margin-left:calc(var(--spacing)*-8)}.flex{display:flex}.hidden{display:none}.inline-block{display:inline-block}.inline-flex{display:inline-flex}.table{display:table}.aspect-\[335\/376\]{aspect-ratio:335/376}.h-1{height:calc(var(--spacing)*1)}.h-1\.5{height:calc(var(--spacing)*1.5)}.h-2{height:calc(var(--spacing)*2)}.h-2\.5{height:calc(var(--spacing)*2.5)}.h-3{height:calc(var(--spacing)*3)}.h-3\.5{height:calc(var(--spacing)*3.5)}.h-14{height:calc(var(--spacing)*14)}.h-14\.5{height:calc(var(--spacing)*14.5)}.min-h-screen{min-height:100vh}.w-1{width:calc(var(--spacing)*1)}.w-1\.5{width:calc(var(--spacing)*1.5)}.w-2{width:calc(var(--spacing)*2)}.w-2\.5{width:calc(var(--spacing)*2.5)}.w-3{width:calc(var(--spacing)*3)}.w-3\.5{width:calc(var(--spacing)*3.5)}.w-\[448px\]{width:448px}.w-full{width:100%}.max-w-\[335px\]{max-width:335px}.max-w-none{max-width:none}.flex-1{flex:1}.shrink-0{flex-shrink:0}.translate-y-0{--tw-translate-y:calc(var(--spacing)*0);translate:var(--tw-translate-x)var(--tw-translate-y)}.transform{transform:var(--tw-rotate-x)var(--tw-rotate-y)var(--tw-rotate-z)var(--tw-skew-x)var(--tw-skew-y)}.flex-col{flex-direction:column}.flex-col-reverse{flex-direction:column-reverse}.items-center{align-items:center}.justify-center{justify-content:center}.justify-end{justify-content:flex-end}.gap-3{gap:calc(var(--spacing)*3)}.gap-4{gap:calc(var(--spacing)*4)}:where(.space-x-1>:not(:last-child)){--tw-space-x-reverse:0;margin-inline-start:calc(calc(var(--spacing)*1)*var(--tw-space-x-reverse));margin-inline-end:calc(calc(var(--spacing)*1)*calc(1 - var(--tw-space-x-reverse)))}.overflow-hidden{overflow:hidden}.rounded-full{border-radius:3.40282e38px}.rounded-sm{border-radius:var(--radius-sm)}.rounded-t-lg{border-top-left-radius:var(--radius-lg);border-top-right-radius:var(--radius-lg)}.rounded-br-lg{border-bottom-right-radius:var(--radius-lg)}.rounded-bl-lg{border-bottom-left-radius:var(--radius-lg)}.border{border-style:var(--tw-border-style);border-width:1px}.border-\[\#19140035\]{border-color:#19140035}.border-\[\#e3e3e0\]{border-color:#e3e3e0}.border-black{border-color:var(--color-black)}.border-transparent{border-color:#0000}.bg-\[\#1b1b18\]{background-color:#1b1b18}.bg-\[\#FDFDFC\]{background-color:#fdfdfc}.bg-\[\#dbdbd7\]{background-color:#dbdbd7}.bg-\[\#fff2f2\]{background-color:#fff2f2}.bg-white{background-color:var(--color-white)}.p-6{padding:calc(var(--spacing)*6)}.px-5{padding-inline:calc(var(--spacing)*5)}.py-1{padding-block:calc(var(--spacing)*1)}.py-1\.5{padding-block:calc(var(--spacing)*1.5)}.py-2{padding-block:calc(var(--spacing)*2)}.pb-12{padding-bottom:calc(var(--spacing)*12)}.text-sm{font-size:var(--text-sm);line-height:var(--tw-leading,var(--text-sm--line-height))}.text-\[13px\]{font-size:13px}.leading-\[20px\]{--tw-leading:20px;line-height:20px}.leading-normal{--tw-leading:var(--leading-normal);line-height:var(--leading-normal)}.font-medium{--tw-font-weight:var(--font-weight-medium);font-weight:var(--font-weight-medium)}.text-\[\#1b1b18\]{color:#1b1b18}.text-\[\#706f6c\]{color:#706f6c}.text-\[\#F53003\],.text-\[\#f53003\]{color:#f53003}.text-white{color:var(--color-white)}.underline{text-decoration-line:underline}.underline-offset-4{text-underline-offset:4px}.opacity-100{opacity:1}.shadow-\[0px_0px_1px_0px_rgba\(0\,0\,0\,0\.03\)\,0px_1px_2px_0px_rgba\(0\,0\,0\,0\.06\)\]{--tw-shadow:0px 0px 1px 0px var(--tw-shadow-color,#00000008),0px 1px 2px 0px var(--tw-shadow-color,#0000000f);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.shadow-\[inset_0px_0px_0px_1px_rgba\(26\,26\,0\,0\.16\)\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#1a1a0029);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.\!filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)!important}.filter{filter:var(--tw-blur,)var(--tw-brightness,)var(--tw-contrast,)var(--tw-grayscale,)var(--tw-hue-rotate,)var(--tw-invert,)var(--tw-saturate,)var(--tw-sepia,)var(--tw-drop-shadow,)}.transition-all{transition-property:all;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.transition-opacity{transition-property:opacity;transition-timing-function:var(--tw-ease,var(--default-transition-timing-function));transition-duration:var(--tw-duration,var(--default-transition-duration))}.delay-300{transition-delay:.3s}.duration-750{--tw-duration:.75s;transition-duration:.75s}.not-has-\[nav\]\:hidden:not(:has(:is(nav))){display:none}.before\:absolute:before{content:var(--tw-content);position:absolute}.before\:top-0:before{content:var(--tw-content);top:calc(var(--spacing)*0)}.before\:top-1\/2:before{content:var(--tw-content);top:50%}.before\:bottom-0:before{content:var(--tw-content);bottom:calc(var(--spacing)*0)}.before\:bottom-1\/2:before{content:var(--tw-content);bottom:50%}.before\:left-\[0\.4rem\]:before{content:var(--tw-content);left:.4rem}.before\:border-l:before{content:var(--tw-content);border-left-style:var(--tw-border-style);border-left-width:1px}.before\:border-\[\#e3e3e0\]:before{content:var(--tw-content);border-color:#e3e3e0}@media (hover:hover){.hover\:border-\[\#1915014a\]:hover{border-color:#1915014a}.hover\:border-\[\#19140035\]:hover{border-color:#19140035}.hover\:border-black:hover{border-color:var(--color-black)}.hover\:bg-black:hover{background-color:var(--color-black)}}@media (width>=64rem){.lg\:-mt-\[6\.6rem\]{margin-top:-6.6rem}.lg\:mb-0{margin-bottom:calc(var(--spacing)*0)}.lg\:mb-6{margin-bottom:calc(var(--spacing)*6)}.lg\:-ml-px{margin-left:-1px}.lg\:ml-0{margin-left:calc(var(--spacing)*0)}.lg\:block{display:block}.lg\:aspect-auto{aspect-ratio:auto}.lg\:w-\[438px\]{width:438px}.lg\:max-w-4xl{max-width:var(--container-4xl)}.lg\:grow{flex-grow:1}.lg\:flex-row{flex-direction:row}.lg\:justify-center{justify-content:center}.lg\:rounded-t-none{border-top-left-radius:0;border-top-right-radius:0}.lg\:rounded-tl-lg{border-top-left-radius:var(--radius-lg)}.lg\:rounded-r-lg{border-top-right-radius:var(--radius-lg);border-bottom-right-radius:var(--radius-lg)}.lg\:rounded-br-none{border-bottom-right-radius:0}.lg\:p-8{padding:calc(var(--spacing)*8)}.lg\:p-20{padding:calc(var(--spacing)*20)}}@media (prefers-color-scheme:dark){.dark\:block{display:block}.dark\:hidden{display:none}.dark\:border-\[\#3E3E3A\]{border-color:#3e3e3a}.dark\:border-\[\#eeeeec\]{border-color:#eeeeec}.dark\:bg-\[\#0a0a0a\]{background-color:#0a0a0a}.dark\:bg-\[\#1D0002\]{background-color:#1d0002}.dark\:bg-\[\#3E3E3A\]{background-color:#3e3e3a}.dark\:bg-\[\#161615\]{background-color:#161615}.dark\:bg-\[\#eeeeec\]{background-color:#eeeeec}.dark\:text-\[\#1C1C1A\]{color:#1c1c1a}.dark\:text-\[\#A1A09A\]{color:#a1a09a}.dark\:text-\[\#EDEDEC\]{color:#ededec}.dark\:text-\[\#F61500\]{color:#f61500}.dark\:text-\[\#FF4433\]{color:#f43}.dark\:shadow-\[inset_0px_0px_0px_1px_\#fffaed2d\]{--tw-shadow:inset 0px 0px 0px 1px var(--tw-shadow-color,#fffaed2d);box-shadow:var(--tw-inset-shadow),var(--tw-inset-ring-shadow),var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.dark\:before\:border-\[\#3E3E3A\]:before{content:var(--tw-content);border-color:#3e3e3a}@media (hover:hover){.dark\:hover\:border-\[\#3E3E3A\]:hover{border-color:#3e3e3a}.dark\:hover\:border-\[\#62605b\]:hover{border-color:#62605b}.dark\:hover\:border-white:hover{border-color:var(--color-white)}.dark\:hover\:bg-white:hover{background-color:var(--color-white)}}}@starting-style{.starting\:translate-y-4{--tw-translate-y:calc(var(--spacing)*4);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:translate-y-6{--tw-translate-y:calc(var(--spacing)*6);translate:var(--tw-translate-x)var(--tw-translate-y)}}@starting-style{.starting\:opacity-0{opacity:0}}}@keyframes spin{to{transform:rotate(360deg)}}@keyframes ping{75%,to{opacity:0;transform:scale(2)}}@keyframes pulse{50%{opacity:.5}}@keyframes bounce{0%,to{animation-timing-function:cubic-bezier(.8,0,1,1);transform:translateY(-25%)}50%{animation-timing-function:cubic-bezier(0,0,.2,1);transform:none}}@property --tw-translate-x{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-y{syntax:"*";inherits:false;initial-value:0}@property --tw-translate-z{syntax:"*";inherits:false;initial-value:0}@property --tw-rotate-x{syntax:"*";inherits:false;initial-value:rotateX(0)}@property --tw-rotate-y{syntax:"*";inherits:false;initial-value:rotateY(0)}@property --tw-rotate-z{syntax:"*";inherits:false;initial-value:rotateZ(0)}@property --tw-skew-x{syntax:"*";inherits:false;initial-value:skewX(0)}@property --tw-skew-y{syntax:"*";inherits:false;initial-value:skewY(0)}@property --tw-space-x-reverse{syntax:"*";inherits:false;initial-value:0}@property --tw-border-style{syntax:"*";inherits:false;initial-value:solid}@property --tw-leading{syntax:"*";inherits:false}@property --tw-font-weight{syntax:"*";inherits:false}@property --tw-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-shadow-color{syntax:"*";inherits:false}@property --tw-inset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-shadow-color{syntax:"*";inherits:false}@property --tw-ring-color{syntax:"*";inherits:false}@property --tw-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-inset-ring-color{syntax:"*";inherits:false}@property --tw-inset-ring-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-ring-inset{syntax:"*";inherits:false}@property --tw-ring-offset-width{syntax:"<length>";inherits:false;initial-value:0}@property --tw-ring-offset-color{syntax:"*";inherits:false;initial-value:#fff}@property --tw-ring-offset-shadow{syntax:"*";inherits:false;initial-value:0 0 #0000}@property --tw-blur{syntax:"*";inherits:false}@property --tw-brightness{syntax:"*";inherits:false}@property --tw-contrast{syntax:"*";inherits:false}@property --tw-grayscale{syntax:"*";inherits:false}@property --tw-hue-rotate{syntax:"*";inherits:false}@property --tw-invert{syntax:"*";inherits:false}@property --tw-opacity{syntax:"*";inherits:false}@property --tw-saturate{syntax:"*";inherits:false}@property --tw-sepia{syntax:"*";inherits:false}@property --tw-drop-shadow{syntax:"*";inherits:false}@property --tw-duration{syntax:"*";inherits:false}@property --tw-content{syntax:"*";inherits:false;initial-value:""}
        </style>
    @endif

    <!-- Custom color overrides for blue/yellow theme -->
    <style>
        .bg-blue-theme { background-color: #2563eb; }
        .bg-yellow-theme { background-color: #fbbf24; }
        .text-blue-theme { color: #2563eb; }
        .text-yellow-theme { color: #fbbf24; }
        .border-blue-theme { border-color: #2563eb; }
        .border-yellow-theme { border-color: #fbbf24; }
        .hover\:bg-blue-theme:hover { background-color: #1d4ed8; }
        .hover\:bg-yellow-theme:hover { background-color: #f59e0b; }
        .dark .bg-blue-theme { background-color: #1e40af; }
        .dark .bg-yellow-theme { background-color: #d97706; }
        .dark .text-blue-theme { color: #60a5fa; }
        .dark .text-yellow-theme { color: #fbbf24; }
        
        .input-field { 
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            transition: border-color 0.15s ease-in-out;
        }
        .input-field:focus { 
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .dark .input-field {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        .dark .input-field:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }
        
        .sidebar {
            width: 260px;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        
        .sidebar-item {
            position: relative;
            transition: all 0.2s ease;
            border-radius: 0.5rem;
        }
        
        .sidebar-item:hover::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 24px;
            width: 4px;
            background: linear-gradient(to bottom, #3b82f6, #60a5fa);
            border-radius: 0 4px 4px 0;
        }
        
        .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .sidebar-item.active .sidebar-icon {
            color: #3b82f6;
        }
        
        .main-content {
            transition: margin-left 0.3s ease;
        }
        
        .card {
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            background: white;
        }
        
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .course-progress {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            background-color: #e5e7eb;
        }
        
        .course-progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
            transition: width 1s ease;
        }
        
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(to bottom right, #ef4444, #f87171);
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }
        
        .profile-image {
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .nav-tab {
            position: relative;
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .nav-tab:hover {
            background-color: #f3f4f6;
        }
        
        .nav-tab.active {
            color: #3b82f6;
            font-weight: 500;
        }
        
        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
            border-radius: 3px 3px 0 0;
        }
        
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .status-online {
            background-color: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
        }
        
        .status-offline {
            background-color: #94a3b8;
            box-shadow: 0 0 0 2px rgba(148, 163, 184, 0.3);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }
        
        .featured-banner {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        /* Mobile Sidebar */
        .mobile-sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        
        .mobile-sidebar-overlay.active {
            display: block;
        }
        
        /* Dark mode adjustments */
        .dark .card {
            background-color: #374151;
            border-color: #4b5563;
        }
        
        .dark .sidebar {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .dark .sidebar-item:hover {
            background-color: #374151;
        }
        
        .dark .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.2);
        }
        
        .dark .featured-banner {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        }
        
        /* Payroll Run Specific Styles - Redesigned Table */
        .payroll-table-container {
            overflow-x: auto;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            background: white;
        }
        
        .payroll-table {
            min-width: 1800px;
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .payroll-table thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .payroll-table th {
            background-color: #f8fafc;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e5e7eb;
            position: relative;
        }
        
        .payroll-table th.group-header {
            background-color: #e0f2fe;
            text-align: center;
            font-size: 0.7rem;
            padding: 8px 4px;
            border-left: 1px solid #e5e7eb;
            border-right: 1px solid #e5e7eb;
        }
        
        .payroll-table th.sub-header {
            background-color: #f1f5f9;
            font-weight: 500;
            font-size: 0.7rem;
            padding: 6px 4px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .payroll-table td {
            vertical-align: middle;
            padding: 12px 8px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .payroll-table tr:hover td {
            background-color: #f8fafc;
        }
        
        .amount-input {
            width: 90px;
            text-align: right;
            font-family: 'SF Mono', Monaco, monospace;
            font-weight: 500;
            padding: 6px 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .amount-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        
        .hours-input {
            width: 70px;
            text-align: center;
            padding: 6px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .hours-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        
        .rate-input {
            width: 80px;
            text-align: right;
            padding: 6px 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .rate-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        
        .department-section {
            background: linear-gradient(to right, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.02));
            border-left: 4px solid #3b82f6;
        }
        
        .department-section td {
            background-color: #f0f9ff;
            font-weight: 600;
            color: #1e40af;
            padding: 12px 16px;
            border-bottom: 2px solid #3b82f6;
        }
        
        .department-section:nth-child(2) {
            border-left-color: #10b981;
        }
        
        .department-section:nth-child(2) td {
            background-color: #f0fdf4;
            color: #065f46;
            border-bottom-color: #10b981;
        }
        
        .department-section:nth-child(3) {
            border-left-color: #f59e0b;
        }
        
        .department-section:nth-child(3) td {
            background-color: #fef3c7;
            color: #92400e;
            border-bottom-color: #f59e0b;
        }
        
        .department-section:nth-child(4) {
            border-left-color: #8b5cf6;
        }
        
        .department-section:nth-child(4) td {
            background-color: #f5f3ff;
            color: #5b21b6;
            border-bottom-color: #8b5cf6;
        }
        
        .total-row {
            background-color: #fef3c7;
            font-weight: 600;
            border-top: 2px solid #fbbf24;
        }
        
        .total-row td {
            padding: 14px 8px;
            border-bottom: none;
        }
        
        .dark .total-row {
            background-color: #78350f;
            border-top-color: #d97706;
        }
        
        .approval-status {
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .net-pay {
            font-weight: 700;
            color: #059669;
            font-size: 0.95rem;
        }
        
        .deduction {
            color: #dc2626;
        }
        
        .addition {
            color: #059669;
        }
        
        .employee-checkbox {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
        
        .section-label {
            font-size: 0.7rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
            display: block;
        }
        
        /* Column grouping styles */
        .col-group {
            position: relative;
        }
        
        .col-group::after {
            content: '';
            position: absolute;
            right: -1px;
            top: 0;
            bottom: 0;
            width: 1px;
            background-color: #e5e7eb;
        }
        
        /* Dark mode table styles */
        .dark .payroll-table-container {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .dark .payroll-table th {
            background-color: #374151;
            border-color: #4b5563;
            color: #d1d5db;
        }
        
        .dark .payroll-table th.group-header {
            background-color: #1e3a8a;
            border-color: #374151;
        }
        
        .dark .payroll-table th.sub-header {
            background-color: #2d3748;
            border-color: #4b5563;
        }
        
        .dark .payroll-table td {
            border-color: #374151;
            color: #d1d5db;
        }
        
        .dark .payroll-table tr:hover td {
            background-color: #2d3748;
        }
        
        .dark .amount-input,
        .dark .hours-input,
        .dark .rate-input {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .dark .department-section td {
            background-color: rgba(59, 130, 246, 0.1);
            color: #93c5fd;
        }
        
        .dark .department-section:nth-child(2) td {
            background-color: rgba(16, 185, 129, 0.1);
            color: #6ee7b7;
        }
        
        .dark .department-section:nth-child(3) td {
            background-color: rgba(245, 158, 11, 0.1);
            color: #fcd34d;
        }
        
        .dark .department-section:nth-child(4) td {
            background-color: rgba(139, 92, 246, 0.1);
            color: #c4b5fd;
        }
        
        /* Fixed columns for better readability */
        .fixed-column {
            position: sticky;
            left: 0;
            background-color: white;
            z-index: 5;
            border-right: 1px solid #e5e7eb;
        }
        
        .dark .fixed-column {
            background-color: #1f2937;
            border-right-color: #374151;
        }
        
        .fixed-column-employee {
            position: sticky;
            left: 40px; /* Width of checkbox column */
            background-color: white;
            z-index: 5;
            border-right: 1px solid #e5e7eb;
            min-width: 200px;
        }
        
        .dark .fixed-column-employee {
            background-color: #1f2937;
            border-right-color: #374151;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                height: 100%;
                top: 0;
                left: 0;
                background: white;
            }
            
            .dark .sidebar {
                background-color: #1f2937;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                width: 100%;
            }
            
            .search-input {
                width: 100%;
            }
            
            .payroll-table {
                min-width: 2200px;
            }
            
            .fixed-column,
            .fixed-column-employee {
                position: static;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .main-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .featured-banner {
                text-align: center;
                padding: 1.5rem !important;
            }
            
            .featured-banner-content {
                padding-right: 0 !important;
            }
            
            .featured-banner img {
                display: none;
            }
            
            .instructors-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .payroll-summary-cards {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .instructors-grid {
                grid-template-columns: 1fr;
            }
            
            .header-title {
                font-size: 1.5rem;
            }
            
            .featured-banner {
                text-align: center;
            }
            
            .featured-banner-button {
                width: 100%;
            }
            
            .payroll-action-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .payroll-action-buttons button {
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Mobile Overlay -->
    <div class="mobile-sidebar-overlay" id="mobile-overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col py-6 px-4 fixed h-full z-10" id="sidebar">
        <div class="flex items-center justify-between px-2 mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-blue-theme flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                </div>
                <span class="font-bold text-xl text-gray-900 dark:text-white">Monti Textile</span>
            </div>
            
            <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <nav class="flex-1 space-y-1">
            <a href="{{ route('hrm.staff.dashboard') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-home"></i>
                </div>
                <span class="sidebar-text font-medium">Employee Information</span>
            </a>
            
            <a href="{{ route('hrm.staff.payroll') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme active">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-money-check-alt"></i>
                </div>
                <span class="sidebar-text font-medium">Payroll Management</span>
            </a>
            
            <a href="{{ route('hrm.staff.leave') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <span class="sidebar-text font-medium">Leave Request</span>
                <span class="ml-auto bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 text-xs font-medium px-2 py-0.5 rounded-full">3</span>
            </a>
            
            <a href="{{ route('hrm.staff.attendance') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-clock"></i>
                </div>
                <span class="sidebar-text font-medium">Time and Attendance</span>
            </a>
            
            <a href="{{ route('hrm.staff.training') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <span class="sidebar-text font-medium">Training Records</span>
            </a>
            
            <div class="py-4 px-4">
                <div class="border-t border-gray-200 dark:border-gray-700"></div>
            </div>
            
            <a href="#" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-cog"></i>
                </div>
                <span class="sidebar-text font-medium">Settings</span>
            </a>
            
            <!-- Updated Logout Button -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span class="sidebar-text font-medium">Logout</span>
            </a>
        </nav>
        
        <div class="px-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="bg-blue-50 dark:bg-blue-900 rounded-xl p-4">
                <div class="text-blue-800 dark:text-blue-200 font-medium text-sm mb-2">Need help?</div>
                <p class="text-blue-600 dark:text-blue-300 text-xs mb-3">Contact our Tech support team for assistance</p>
                <button class="w-full bg-blue-theme hover:bg-blue-700 text-white py-2 rounded-lg text-xs font-medium transition-colors">
                    Get Help
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 ml-64 min-h-screen flex flex-col" id="main-content">
        <!-- Top Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-4 px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="header-content flex items-center justify-between w-full">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">Process Payroll Run</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Set employee rates and submit for HR approval</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-700 dark:text-blue-300 font-medium hidden md:flex">
                            PO
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 overflow-y-auto custom-scrollbar">
            <!-- Payroll Run Header -->
            <div class="card p-6 mb-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">November 2023 Payroll Run</h2>
                        <div class="flex items-center flex-wrap gap-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt text-blue-theme mr-2"></i>
                                <span class="text-gray-600 dark:text-gray-400">Pay Period: Nov 1 - Nov 30, 2023</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-blue-theme mr-2"></i>
                                <span class="text-gray-600 dark:text-gray-400">Employees: 245</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-money-bill-wave text-blue-theme mr-2"></i>
                                <span class="text-gray-600 dark:text-gray-400">Total Estimated: ₱850,250</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 payroll-action-buttons">
                        <a href="{{ route('hrm.staff.payroll') }}" class="px-4 py-2.5 bg-white border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Payroll
                        </a>
                        <button id="submit-for-approval" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i> Submit for HR Approval
                        </button>
                    </div>
                </div>
                
                <!-- Progress Indicator -->
                <div class="mt-6">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 dark:text-gray-400">Payroll Processing Progress</span>
                        <span class="text-blue-theme font-medium">65% Complete</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="bg-green-600 h-2.5 rounded-full" style="width: 65%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <span>160 Employees Processed</span>
                        <span>85 Employees Pending</span>
                    </div>
                </div>
            </div>

            <!-- Quick Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 payroll-summary-cards">
                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Basic Salary Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">₱720,500</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-money-bill text-blue-600 dark:text-blue-300 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Overtime Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">₱45,750</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600 dark:text-yellow-300 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Deductions Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">₱127,538</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900 flex items-center justify-center">
                            <i class="fas fa-minus-circle text-red-600 dark:text-red-300 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Net Pay Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white">₱638,712</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <i class="fas fa-hand-holding-usd text-green-600 dark:text-green-300 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Department Tabs -->
            <div class="mb-6">
                <div class="flex flex-wrap gap-2 mb-4">
                    <button class="px-4 py-2 rounded-lg bg-blue-theme text-white font-medium department-tab active" data-department="all">
                        All Departments
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium department-tab" data-department="production">
                        Production
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium department-tab" data-department="quality">
                        Quality Control
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium department-tab" data-department="maintenance">
                        Maintenance
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium department-tab" data-department="warehouse">
                        Warehouse
                    </button>
                </div>
                
                <!-- Bulk Actions -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="select-all" class="employee-checkbox h-4 w-4 text-blue-600 rounded border-gray-300">
                            <label for="select-all" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Select All</label>
                        </div>
                        
                        <select class="input-field text-sm py-1.5" id="bulk-action">
                            <option value="">Bulk Actions</option>
                            <option value="apply-bonus">Apply 13th Month Bonus</option>
                            <option value="increase-5">Increase 5%</option>
                            <option value="apply-overtime">Apply Overtime</option>
                            <option value="reset">Reset to Default</option>
                        </select>
                        
                        <button id="apply-bulk-action" class="px-4 py-1.5 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg text-sm font-medium hover:bg-blue-200 dark:hover:bg-blue-800">
                            Apply
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-lg text-sm font-medium hover:bg-yellow-200 dark:hover:bg-yellow-800">
                            <i class="fas fa-download mr-2"></i> Export
                        </button>
                        <button class="px-4 py-2 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg text-sm font-medium hover:bg-green-200 dark:hover:bg-green-800">
                            <i class="fas fa-calculator mr-2"></i> Recalculate All
                        </button>
                    </div>
                </div>
            </div>

            <!-- Payroll Table -->
            <div class="payroll-table-container">
                <table class="payroll-table">
                    <thead>
                        <!-- Group Headers Row -->
                        <tr>
                            <th class="py-3 px-4 text-left" rowspan="2">
                                <input type="checkbox" id="select-all-header" class="employee-checkbox">
                            </th>
                            <th class="py-3 px-4 text-left fixed-column-employee" rowspan="2">Employee</th>
                            <th class="py-3 px-4 text-left" rowspan="2">Department</th>
                            <th class="py-3 px-4 text-left" rowspan="2">Basic Rate</th>
                            
                            <th class="py-3 px-4 text-center group-header col-group" colspan="3">Night Differential</th>
                            <th class="py-3 px-4 text-center group-header col-group" colspan="3">Overtime</th>
                            <th class="py-3 px-4 text-center group-header col-group" colspan="3">Sunday/Special Holiday</th>
                            <th class="py-3 px-4 text-center group-header col-group" colspan="3">Regular Holiday</th>
                            <th class="py-3 px-4 text-center group-header col-group" colspan="3">Late Deductions</th>
                            
                            <th class="py-3 px-4 text-left" rowspan="2">SSS</th>
                            <th class="py-3 px-4 text-left" rowspan="2">PhilHealth</th>
                            <th class="py-3 px-4 text-left" rowspan="2">Pag-IBIG</th>
                            
                            <th class="py-3 px-4 text-left" rowspan="2">Gross Pay</th>
                            <th class="py-3 px-4 text-left" rowspan="2">Total Deductions</th>
                            <th class="py-3 px-4 text-left" rowspan="2">Net Pay</th>
                            <th class="py-3 px-4 text-left" rowspan="2">Status</th>
                        </tr>
                        
                        <!-- Sub Headers Row -->
                        <tr>
                            <!-- Night Differential Subheaders -->
                            <th class="sub-header text-center">Hours</th>
                            <th class="sub-header text-center">Rate</th>
                            <th class="sub-header text-center">Amount</th>
                            
                            <!-- Overtime Subheaders -->
                            <th class="sub-header text-center">Hours</th>
                            <th class="sub-header text-center">Rate</th>
                            <th class="sub-header text-center">Amount</th>
                            
                            <!-- Sunday/Special Holiday Subheaders -->
                            <th class="sub-header text-center">Hours</th>
                            <th class="sub-header text-center">Rate</th>
                            <th class="sub-header text-center">Amount</th>
                            
                            <!-- Regular Holiday Subheaders -->
                            <th class="sub-header text-center">Hours</th>
                            <th class="sub-header text-center">Rate</th>
                            <th class="sub-header text-center">Amount</th>
                            
                            <!-- Late Deductions Subheaders -->
                            <th class="sub-header text-center">Minutes</th>
                            <th class="sub-header text-center">Rate/Min</th>
                            <th class="sub-header text-center">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Production Department -->
                        <tr class="department-section">
                            <td colspan="25" class="py-3 px-4">
                                <i class="fas fa-industry mr-2"></i> Production Department (85 Employees)
                            </td>
                        </tr>
                        
                        <!-- Employee Rows -->
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="py-4 px-4 fixed-column">
                                <input type="checkbox" class="employee-checkbox h-4 w-4 text-blue-600 rounded border-gray-300">
                            </td>
                            <td class="py-4 px-4 fixed-column-employee">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-medium text-sm mr-3">
                                        JD
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">John Dela Cruz</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">EMP-2023-001</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs rounded-full">Production</span>
                            </td>
                            
                            <!-- Basic Rate -->
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="18500" class="amount-input pl-8" data-type="basic">
                                </div>
                            </td>
                            
                            <!-- Night Differential -->
                            <td class="py-4 px-2">
                                <input type="text" value="8" class="hours-input" data-type="night-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="100" class="rate-input pl-6" data-type="night-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="800" class="amount-input pl-8 addition" data-type="night-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Overtime -->
                            <td class="py-4 px-2">
                                <input type="text" value="4" class="hours-input" data-type="ot-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="150" class="rate-input pl-6" data-type="ot-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="600" class="amount-input pl-8 addition" data-type="ot-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Sunday/Special Holiday -->
                            <td class="py-4 px-2">
                                <input type="text" value="0" class="hours-input" data-type="sunday-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="200" class="rate-input pl-6" data-type="sunday-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="0" class="amount-input pl-8 addition" data-type="sunday-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Regular Holiday -->
                            <td class="py-4 px-2">
                                <input type="text" value="0" class="hours-input" data-type="holiday-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="250" class="rate-input pl-6" data-type="holiday-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="0" class="amount-input pl-8 addition" data-type="holiday-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Late Deductions -->
                            <td class="py-4 px-2">
                                <input type="text" value="15" class="hours-input" data-type="late-minutes">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="5" class="rate-input pl-6" data-type="late-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="75" class="amount-input pl-8 deduction" data-type="late-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Statutory Deductions -->
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="750" class="amount-input pl-8 deduction" data-type="sss">
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="300" class="amount-input pl-8 deduction" data-type="philhealth">
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="100" class="amount-input pl-8 deduction" data-type="pagibig">
                                </div>
                            </td>
                            
                            <!-- Totals -->
                            <td class="py-4 px-4">
                                <div class="font-medium text-gray-900 dark:text-white gross-pay">₱19,900</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-medium text-red-600 dark:text-red-400 total-deductions">₱1,225</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="net-pay font-bold">₱18,675</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="approval-status status-pending">Pending</span>
                            </td>
                        </tr>
                        
                        <!-- Additional sample employee -->
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="py-4 px-4 fixed-column">
                                <input type="checkbox" class="employee-checkbox h-4 w-4 text-blue-600 rounded border-gray-300">
                            </td>
                            <td class="py-4 px-4 fixed-column-employee">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 font-medium text-sm mr-3">
                                        MS
                                    </div>
                                    <div>
                                        <div class="font-medium text-gray-900 dark:text-white">Maria Santos</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">EMP-2023-045</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs rounded-full">Production</span>
                            </td>
                            
                            <!-- Basic Rate -->
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="21300" class="amount-input pl-8" data-type="basic">
                                </div>
                            </td>
                            
                            <!-- Night Differential -->
                            <td class="py-4 px-2">
                                <input type="text" value="12" class="hours-input" data-type="night-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="100" class="rate-input pl-6" data-type="night-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="1200" class="amount-input pl-8 addition" data-type="night-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Overtime -->
                            <td class="py-4 px-2">
                                <input type="text" value="8" class="hours-input" data-type="ot-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="150" class="rate-input pl-6" data-type="ot-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="1200" class="amount-input pl-8 addition" data-type="ot-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Sunday/Special Holiday -->
                            <td class="py-4 px-2">
                                <input type="text" value="4" class="hours-input" data-type="sunday-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="200" class="rate-input pl-6" data-type="sunday-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="800" class="amount-input pl-8 addition" data-type="sunday-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Regular Holiday -->
                            <td class="py-4 px-2">
                                <input type="text" value="0" class="hours-input" data-type="holiday-hours">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="250" class="rate-input pl-6" data-type="holiday-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="0" class="amount-input pl-8 addition" data-type="holiday-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Late Deductions -->
                            <td class="py-4 px-2">
                                <input type="text" value="0" class="hours-input" data-type="late-minutes">
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-xs text-gray-400">₱</span>
                                    <input type="text" value="5" class="rate-input pl-6" data-type="late-rate">
                                </div>
                            </td>
                            <td class="py-4 px-2">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="0" class="amount-input pl-8 deduction" data-type="late-amount" readonly>
                                </div>
                            </td>
                            
                            <!-- Statutory Deductions -->
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="800" class="amount-input pl-8 deduction" data-type="sss">
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="350" class="amount-input pl-8 deduction" data-type="philhealth">
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="text" value="100" class="amount-input pl-8 deduction" data-type="pagibig">
                                </div>
                            </td>
                            
                            <!-- Totals -->
                            <td class="py-4 px-4">
                                <div class="font-medium text-gray-900 dark:text-white gross-pay">₱24,500</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-medium text-red-600 dark:text-red-400 total-deductions">₱1,250</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="net-pay font-bold">₱23,250</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="approval-status status-pending">Pending</span>
                            </td>
                        </tr>

                        <!-- Totals Row -->
                        <tr class="total-row">
                            <td class="py-4 px-4 font-bold" colspan="4">TOTALS (245 Employees)</td>
                            <td class="py-4 px-2 font-bold">1,240 hrs</td>
                            <td class="py-4 px-2"></td>
                            <td class="py-4 px-2 font-bold addition">₱124,000</td>
                            
                            <td class="py-4 px-2 font-bold">980 hrs</td>
                            <td class="py-4 px-2"></td>
                            <td class="py-4 px-2 font-bold addition">₱147,000</td>
                            
                            <td class="py-4 px-2 font-bold">320 hrs</td>
                            <td class="py-4 px-2"></td>
                            <td class="py-4 px-2 font-bold addition">₱64,000</td>
                            
                            <td class="py-4 px-2 font-bold">120 hrs</td>
                            <td class="py-4 px-2"></td>
                            <td class="py-4 px-2 font-bold addition">₱30,000</td>
                            
                            <td class="py-4 px-2 font-bold">2,450 min</td>
                            <td class="py-4 px-2"></td>
                            <td class="py-4 px-2 font-bold deduction">₱12,250</td>
                            
                            <td class="py-4 px-4 font-bold deduction">₱42,500</td>
                            <td class="py-4 px-4 font-bold deduction">₱18,375</td>
                            <td class="py-4 px-4 font-bold deduction">₱6,125</td>
                            
                            <td class="py-4 px-4 font-bold text-xl">₱1,085,500</td>
                            <td class="py-4 px-4 font-bold text-xl deduction">₱127,250</td>
                            <td class="py-4 px-4 font-bold text-xl text-green-600 dark:text-green-400">₱958,250</td>
                            <td class="py-4 px-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Submission Section -->
            <div class="card p-6 mt-8">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Submit for HR Manager Approval</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select HR Manager</label>
                            <select class="input-field w-full">
                                <option value="">Choose HR Manager</option>
                                <option value="1" selected>Anna Gomez - HR Director</option>
                                <option value="2">Mark Reyes - HR Manager</option>
                                <option value="3">Lisa Cruz - HR Supervisor</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Date</label>
                            <input type="date" class="input-field w-full" value="2023-11-30">
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Method</label>
                            <select class="input-field w-full">
                                <option value="bank">Bank Transfer</option>
                                <option value="cash">Cash</option>
                                <option value="check">Check</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes for HR Manager</label>
                            <textarea class="input-field w-full h-32" placeholder="Add any special notes or instructions for the HR manager..."></textarea>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="send-email" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                            <label for="send-email" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Send email notification to HR Manager</label>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="generate-payslips" class="h-4 w-4 text-blue-600 rounded border-gray-300" checked>
                            <label for="generate-payslips" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Generate payslips automatically</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" id="lock-payroll" class="h-4 w-4 text-blue-600 rounded border-gray-300" checked>
                            <label for="lock-payroll" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Lock payroll after submission</label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                    <button type="button" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-600 mr-4">
                        Save as Draft
                    </button>
                    <button id="final-submit" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors flex items-center">
                        <i class="fas fa-paper-plane mr-2"></i> Submit for Approval
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- Approval Confirmation Modal -->
    <div id="approval-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 dark:bg-green-900 rounded-full mb-4">
                    <i class="fas fa-check text-green-600 dark:text-green-300 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-2">Submit for Approval?</h3>
                <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                    You are about to submit the November 2023 payroll for HR Manager approval. This action cannot be undone.
                </p>
                
                <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4 mb-6">
                    <div class="flex justify-between mb-2">
                        <span class="text-blue-800 dark:text-blue-200">Total Employees:</span>
                        <span class="font-medium">245</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-blue-800 dark:text-blue-200">Gross Pay Total:</span>
                        <span class="font-medium">₱1,085,500</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-blue-800 dark:text-blue-200">Total Deductions:</span>
                        <span class="font-medium">₱127,250</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-blue-800 dark:text-blue-200">Net Pay Total:</span>
                        <span class="font-medium">₱958,250</span>
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-blue-800 dark:text-blue-200">HR Manager:</span>
                        <span class="font-medium">Anna Gomez</span>
                    </div>
                </div>
                
                <div class="flex justify-center space-x-4">
                    <button id="cancel-approval" class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-600">
                        Cancel
                    </button>
                    <button id="confirm-approval" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                        Confirm Submission
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        // Function to toggle sidebar
        function toggleSidebar() {
            if (window.innerWidth < 1024) {
                // Mobile behavior
                sidebar.classList.toggle('active');
                mobileOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
            }
        }
        
        // Function to close sidebar on mobile
        function closeSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        // Event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileMenuToggle.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', closeSidebar);
        
        // Department Tab Functionality
        const departmentTabs = document.querySelectorAll('.department-tab');
        departmentTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                departmentTabs.forEach(t => t.classList.remove('active', 'bg-blue-theme', 'text-white'));
                departmentTabs.forEach(t => t.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300'));
                
                tab.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                tab.classList.add('active', 'bg-blue-theme', 'text-white');
                
                const department = tab.dataset.department;
                // Filter functionality would go here
            });
        });
        
        // Select All Checkbox
        const selectAllCheckbox = document.getElementById('select-all');
        const selectAllHeader = document.getElementById('select-all-header');
        const employeeCheckboxes = document.querySelectorAll('.employee-checkbox');
        
        function updateSelectAll() {
            const allChecked = Array.from(employeeCheckboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
            selectAllHeader.checked = allChecked;
        }
        
        selectAllCheckbox.addEventListener('change', () => {
            employeeCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            selectAllHeader.checked = selectAllCheckbox.checked;
        });
        
        selectAllHeader.addEventListener('change', () => {
            employeeCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllHeader.checked;
            });
            selectAllCheckbox.checked = selectAllHeader.checked;
        });
        
        employeeCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectAll);
        });
        
        // Bulk Action
        const bulkActionSelect = document.getElementById('bulk-action');
        const applyBulkActionBtn = document.getElementById('apply-bulk-action');
        
        applyBulkActionBtn.addEventListener('click', () => {
            const action = bulkActionSelect.value;
            if (!action) {
                alert('Please select a bulk action first');
                return;
            }
            
            const selectedEmployees = Array.from(employeeCheckboxes).filter(cb => cb.checked);
            if (selectedEmployees.length === 0) {
                alert('Please select at least one employee');
                return;
            }
            
            // Apply bulk action logic
            switch(action) {
                case 'apply-bonus':
                    alert(`Applying 13th month bonus to ${selectedEmployees.length} employees`);
                    break;
                case 'increase-5':
                    alert(`Increasing salary by 5% for ${selectedEmployees.length} employees`);
                    break;
                case 'apply-overtime':
                    alert(`Applying overtime to ${selectedEmployees.length} employees`);
                    break;
                case 'reset':
                    alert(`Resetting ${selectedEmployees.length} employees to default rates`);
                    break;
            }
            
            bulkActionSelect.value = '';
        });
        
        // Calculate amount when hours/rates change
        function calculateAmounts(row) {
            // Night Differential
            const nightHours = parseFloat(row.querySelector('input[data-type="night-hours"]').value) || 0;
            const nightRate = parseFloat(row.querySelector('input[data-type="night-rate"]').value) || 0;
            const nightAmount = nightHours * nightRate;
            row.querySelector('input[data-type="night-amount"]').value = nightAmount.toFixed(2);
            
            // Overtime
            const otHours = parseFloat(row.querySelector('input[data-type="ot-hours"]').value) || 0;
            const otRate = parseFloat(row.querySelector('input[data-type="ot-rate"]').value) || 0;
            const otAmount = otHours * otRate;
            row.querySelector('input[data-type="ot-amount"]').value = otAmount.toFixed(2);
            
            // Sunday/Special Holiday
            const sundayHours = parseFloat(row.querySelector('input[data-type="sunday-hours"]').value) || 0;
            const sundayRate = parseFloat(row.querySelector('input[data-type="sunday-rate"]').value) || 0;
            const sundayAmount = sundayHours * sundayRate;
            row.querySelector('input[data-type="sunday-amount"]').value = sundayAmount.toFixed(2);
            
            // Regular Holiday
            const holidayHours = parseFloat(row.querySelector('input[data-type="holiday-hours"]').value) || 0;
            const holidayRate = parseFloat(row.querySelector('input[data-type="holiday-rate"]').value) || 0;
            const holidayAmount = holidayHours * holidayRate;
            row.querySelector('input[data-type="holiday-amount"]').value = holidayAmount.toFixed(2);
            
            // Late Deductions
            const lateMinutes = parseFloat(row.querySelector('input[data-type="late-minutes"]').value) || 0;
            const lateRate = parseFloat(row.querySelector('input[data-type="late-rate"]').value) || 0;
            const lateAmount = lateMinutes * lateRate;
            row.querySelector('input[data-type="late-amount"]').value = lateAmount.toFixed(2);
            
            // Calculate totals
            calculateNetPay(row);
        }
        
        // Auto-calculate net pay when inputs change
        const allInputs = document.querySelectorAll('.hours-input, .rate-input, .amount-input');
        allInputs.forEach(input => {
            input.addEventListener('input', function() {
                const row = this.closest('tr');
                if (row && !row.classList.contains('total-row')) {
                    calculateAmounts(row);
                }
            });
        });
        
        function calculateNetPay(row) {
            if (row.classList.contains('total-row')) return;
            
            const basic = parseFloat(row.querySelector('input[data-type="basic"]').value) || 0;
            const nightAmount = parseFloat(row.querySelector('input[data-type="night-amount"]').value) || 0;
            const otAmount = parseFloat(row.querySelector('input[data-type="ot-amount"]').value) || 0;
            const sundayAmount = parseFloat(row.querySelector('input[data-type="sunday-amount"]').value) || 0;
            const holidayAmount = parseFloat(row.querySelector('input[data-type="holiday-amount"]').value) || 0;
            const lateAmount = parseFloat(row.querySelector('input[data-type="late-amount"]').value) || 0;
            const sss = parseFloat(row.querySelector('input[data-type="sss"]').value) || 0;
            const philhealth = parseFloat(row.querySelector('input[data-type="philhealth"]').value) || 0;
            const pagibig = parseFloat(row.querySelector('input[data-type="pagibig"]').value) || 0;
            
            const grossPay = basic + nightAmount + otAmount + sundayAmount + holidayAmount - lateAmount;
            const totalDeductions = sss + philhealth + pagibig + lateAmount;
            const netPay = grossPay - totalDeductions;
            
            row.querySelector('.gross-pay').textContent = `₱${grossPay.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            row.querySelector('.total-deductions').textContent = `₱${totalDeductions.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
            row.querySelector('.net-pay').textContent = `₱${netPay.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        }
        
        // Initialize calculations for all rows
        document.addEventListener('DOMContentLoaded', () => {
            const employeeRows = document.querySelectorAll('tbody tr:not(.department-section):not(.total-row)');
            employeeRows.forEach(row => {
                calculateAmounts(row);
            });
        });
        
        // Approval Modal
        const submitForApprovalBtn = document.getElementById('submit-for-approval');
        const finalSubmitBtn = document.getElementById('final-submit');
        const approvalModal = document.getElementById('approval-modal');
        const cancelApprovalBtn = document.getElementById('cancel-approval');
        const confirmApprovalBtn = document.getElementById('confirm-approval');
        
        function showApprovalModal() {
            approvalModal.classList.remove('hidden');
        }
        
        function hideApprovalModal() {
            approvalModal.classList.add('hidden');
        }
        
        submitForApprovalBtn.addEventListener('click', showApprovalModal);
        finalSubmitBtn.addEventListener('click', showApprovalModal);
        cancelApprovalBtn.addEventListener('click', hideApprovalModal);
        
        confirmApprovalBtn.addEventListener('click', () => {
            // Submit form logic here
            alert('Payroll submitted successfully for HR Manager approval!');
            hideApprovalModal();
            
            // Redirect to payroll page after submission
            setTimeout(() => {
                window.location.href = "{{ route('hrm.staff.payroll') }}";
            }, 1500);
        });
        
        // Initialize progress animations
        document.addEventListener('DOMContentLoaded', () => {
            // Handle responsive behavior on load
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
                sidebar.classList.remove('collapsed');
                
                // Close sidebar if open when resizing to mobile
                if (sidebar.classList.contains('active')) {
                    document.body.style.overflow = '';
                }
            } else {
                // Reset to desktop behavior
                mobileOverlay.classList.remove('active');
                sidebar.classList.remove('active');
                document.body.style.overflow = '';
                
                // Apply collapsed state if needed
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>