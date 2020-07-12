import  React, { useState, useCallback } from "react"
import { Link } from "gatsby"

import { rhythm, scale } from "../utils/typography"

const Layout = ({ location, title, children }) => {

  const [navDisplay, setNavDisplay] = useState(false);

  const handleBtnClick = useCallback(() => setNavDisplay(true))

  const handleNavClick = useCallback(() => setNavDisplay(false))

  const handleKeyPress = useCallback((event) => {
    if (event.keyCode === 27) {
      setNavDisplay(false)
    }
  })

  const rootPath = `${__PATH_PREFIX__}/`
  let header

  if (location.pathname === rootPath) {
    header = (
      <h1
        style={{
          ...scale(1.5),
          marginBottom: rhythm(1.5),
          marginTop: 0,
        }}
      >
        <Link
          style={{
            boxShadow: `none`,
            color: `inherit`,
          }}
          to={`/`}
        >
          {title}
        </Link>
      </h1>
    )
  } else {
    header = (
      <h3
        style={{
          fontFamily: `Montserrat, sans-serif`,
          marginTop: 0,
        }}
      >
        <Link
          style={{
            boxShadow: `none`,
            color: `inherit`,
          }}
          to={`/`}
        >
          {title}
        </Link>
      </h3>
    )
  }
  return (
    <div style={{
      position: `relative`,
    }}
    >
      <div style={{
        position: `fixed`,
        top: `20px`,
        left: `20px`,
        marginBottom: `20px`,
        width: `35px`,
        height: `35px`,
        outline: `none`,
        transition: `transform .3s cubic-bezier(0, .52, 0, 1)`,
        cursor: `pointer`,
      }}
           onClick={handleBtnClick}
           onKeyDown={handleKeyPress}
      >
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAABCklEQVRoge2aTQ6CMBCFn8alBxO9sxtN/DmFAe+BCyTWhtridNrRvC9hA6RvXjsMnaQA+U32APqK1yEW4CLRSJ/4niYfY13lHEyJpElcakdRChqxhtTIDsAdQAegkYejz1gGfTrnWevcXwO4IU+JDWm/YSm1ipT40Kw0GFalBbAprF1/MA1tS6klQmrkiteMneXh6BNaXr/yjLBqlRCZEro4z06FtesPpqFtKbVE0Ig1aMQaNPKEjdXExS3KXBE2ViW0LaWWCDZW3n02Vg5srKoNpqFtKbVESI1sMfwQudcCq9b3IqG9VgvutfJpW0otETRijb8xMvfkQ60PPkrqihxVo4gTPVRDrPEAofTUqIjVSB4AAAAASUVORK5CYII="/>
      </div>
      <div
        style={{
          marginLeft:  `auto`,
          marginRight: `auto`,
          maxWidth:    rhythm(24),
          padding:     `${rhythm(1.5)} ${rhythm(3 / 4)}`
        }}
      >
        <header>{header}</header>
        <main>{children}</main>
        <footer>
          © {new Date().getFullYear()}, Built with ❤️
          {` & `}
          <a href="https://www.gatsbyjs.org">Gatsby</a>
        </footer>
      </div>
      <nav style={{
        position: `fixed`,
        background: `white`,
        width: `100vw`,
        height: `100vh`,
        transform: navDisplay ? `translate3d(0, 0, 0)` : `translate3d(-100vw, 0, 0)`,
        transition: `transform .3s cubic-bezier(0, .52, 0, 1)`,
        top: `0`,
        left: `0`,
        ...scale(0.5),
      }}
           onClick={handleNavClick}
           onKeyPress={handleNavClick}
      >
        <ul style={{
          listStyle: `none`,
          marginTop: rhythm( 1 ),
        }}
        >
          <li><Link to="/about">About</Link></li>
          <li><Link to="/now">Now</Link></li>
          <li><Link to="/about">Contact</Link></li>
        </ul>
      </nav>
    </div>
  )
}

export default Layout
