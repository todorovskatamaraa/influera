<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield("title", "Register")</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Inter:wght@400;500;600&display=swap"
      rel="stylesheet"
    />

    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>

  <body
    class="flex flex-col min-h-screen text-foreground font-sans bg-background antialiased"
  >
    <div class="bg-curve"></div>

    {{-- Navbar --}}
    <nav
      class="z-50 w-full bg-white/80 border-b border-slate-100 backdrop-blur-sm sticky top-0"
    >
      <div
        class="container flex h-16 mx-auto px-6 items-center justify-between md:px-12 lg:px-24"
      >
        
        {{-- LEFT SIDE: LOGO --}}
        <div class="flex items-center gap-2">
          <img
            src="/images/icons/logo.png"
            alt="influera logo"
            class="w-10 h-10"
          />
          <span class="font-bold text-xl tracking-tight text-slate-900">
            Influera
          </span>
        </div>

        {{-- RIGHT SIDE: LOGOUT BUTTON --}}
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button
            type="submit"
            class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-full hover:bg-red-600 transition"
          >
            Log out
          </button>
        </form>

      </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1 flex flex-col items-center justify-center py-16 px-6 container mx-auto">
      @yield("content")
    </main>
    
  </body>
</html>
