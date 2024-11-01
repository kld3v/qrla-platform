export function formatNumberWithCommas(number: number | string): string | number {
	const parsedNumber = typeof number === 'string' ? parseFloat(number) : number
	return isNaN(parsedNumber) ? number : parsedNumber.toLocaleString()
}
