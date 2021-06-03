
// https://github.com/jsdom/jsdom#executing-scripts

import { fireEvent, getByText } from '@testing-library/dom'
import '@testing-library/jest-dom/extend-expect'
import { JSDOM } from 'jsdom'
import fs from 'fs'
import path from 'path'

const html = fs.readFileSync(path.resolve(__dirname, '../Agon.html'), 'utf8');

let dom
let container

// common one
describe('Agon.html', () => {
  beforeEach(() => {
    dom = new JSDOM(html, { runScripts: 'dangerously' })
    container = dom.window.document.body
  })

  // checks buttons on the page
  it('renders a button', async () => {
    const button = getByText(container, "Let's Go")
    fireEvent.click(button)

  })

  // checks if h1 tag has a certain text
  it('renders a heading 1 element', () => {
    expect(container.querySelector('h1')).not.toBeNull()
    expect(getByText(container, 'A G O N')).toBeInTheDocument()
  })


  
})