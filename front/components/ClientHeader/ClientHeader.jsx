import Link from "next/link";
import { useRouter } from "next/router";

const ClientHeader = () => {
    const router = useRouter();
    const activeLinkClasses = "bg-red-900 text-white px-3 py-2 rounded-md text-sm font-medium";
    const inactiveLinkClasses = "text-red-200 hover:bg-red-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium";
    const mobileActiveLinkClasses = "bg-red-900 text-white block px-3 py-2 rounded-md text-base font-medium";
    const mobileInactiveLinkClasses = "text-red-200 hover:bg-red-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium";
    return <nav className="bg-red-500">
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div className="flex items-center justify-between h-16">
        <div className="flex items-center">
          <div className="flex-shrink-0">
            <img className="h-8 w-8" src="https://assets.wprock.fr/emoji/joypixels/512/1f1f0-1f1ed.png" alt="Workflow" />
          </div>
          <div className="hidden md:block">
            <div className="ml-10 flex items-baseline space-x-4">
              <Link href="/">
                <a className={router.pathname == "/" ? activeLinkClasses : inactiveLinkClasses}>
                  Menu
                </a>
              </Link>
              <Link href="/réservation">
                <a className={router.pathname == "/réservation" ? activeLinkClasses : inactiveLinkClasses}>
                  Réservation
                </a>
              </Link>
              <Link href="/panier">
                <a className={router.pathname == "/panier" ? activeLinkClasses : inactiveLinkClasses}>
                  Panier
                </a>
              </Link>
            </div>
          </div>
        </div>
        <div className="hidden md:block">
          <div className="ml-4 flex items-center md:ml-6">
          </div>
        </div>
        <div className="-mr-2 flex md:hidden">
          <button type="button" className="bg-red-700 inline-flex items-center justify-center p-2 rounded-md text-red-300 hover:text-white hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-700 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span className="sr-only">Open main menu</span>
            <svg className="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg className="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    <div className="md:hidden" id="mobile-menu">
      <div className="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <Link href="/">
          <a className={router.pathname == "/" ? mobileActiveLinkClasses : mobileInactiveLinkClasses}>
            Menu
          </a>
        </Link>
        <Link href="/réservation">
          <a className={router.pathname == "/réservation" ? mobileActiveLinkClasses : mobileInactiveLinkClasses}>
            Réservation
          </a>
        </Link>
        <Link href="/panier">
          <a className={router.pathname == "/panier" ? mobileActiveLinkClasses : mobileInactiveLinkClasses}>
            Panier
          </a>
        </Link>
      </div>
    </div>
  </nav>;
}

export default ClientHeader;