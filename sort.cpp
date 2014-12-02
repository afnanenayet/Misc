#include <iostream>
#include <fstream>
#include <sys/types.h>
#include <stdio.h>
#include <string>
#include <sstream> //preprocessor directives
#include <vector>
#include <math.h>
#include <algorithm>
#include <sys/time.h>

using namespace std;

template< typename BidirectionalIterator, typename Compare >
void Sort(BidirectionalIterator first, BidirectionalIterator last, Compare cmp) {
	if (first != last) {
		BidirectionalIterator left = first;
		BidirectionalIterator right = last;
		BidirectionalIterator pivot = left++;

		while (left != right) {
			if (cmp(*left, *pivot)) {
				++left;
			}
			else {
				while ((left != right) && cmp(*pivot, *right))
					--right;
				std::iter_swap(left, right);
			}
		}

		--left;
		std::iter_swap(pivot, left);

		quick_sort(first, left, cmp);
		quick_sort(right, last, cmp);
	}
}

bool isNumeric(const std::string& str) {
	string::const_iterator it = str.begin();
	while (it != str.end() && isdigit(*it)) ++it;
	return !str.empty() && it == str.end();
}

template <typename T>
T StringToNumber(const string &Text)//Text not by const reference so that the function can be used with a 
{                               //character array as argument
	stringstream ss(Text);
	T result;
	return ss >> result ? result : 0;
}

int main() {

	string fileName;
	int invalidCounter = 0;
	string buffer;
	timeval start, end, iter;
	cout << "Enter filename: ";//gets file name
	getline(cin, fileName);
	string filePath = "/home/gschool/" + fileName + ".nbrs";
	ifstream fIn(filePath.c_str());

	gettimeofday(&start, NULL);
	double a = start.tv_sec + .000001 * start.tv_usec;

	std::vector<int> value_array;
	while (getline(fIn, buffer))
	{
		if (isNumeric(buffer)) {
			value_array.push_back(StringToNumber<int>(buffer));
		}
	}
	fIn.close();
	std::sort(value_array.begin(), value_array.end());
	gettimeofday(&end, NULL);
	double b = end.tv_sec + .000001 * end.tv_usec;

	//print out vector
	for (std::vector<int>::const_iterator i = value_array.begin(); i != value_array.end(); ++i)
		std::cout << *i << ' ' << endl;
	//gettimeofday(&iter, NULL);
	//double c = iter.tv_sec + .000001 * iter.tv_usec;
	//get elapsed time
	cout << endl << "Time to sort numbers: " << (b - a) << " seconds" << endl;
	//cout << "Time to sort + display numbers: " << (c -a) << " seconds" << endl;
	return 0;
}
